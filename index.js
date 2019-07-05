
var express = require('express')

var cookieParser = require('cookie-parser')
const cookieEncrypter = require('cookie-encrypter');

const secretKey = 'kjfs9032fsb389d0s0brwe0ren32iqn3';

var app = express()

app.use(cookieParser(secretKey));
app.use(cookieEncrypter(secretKey));



//requires nodemailer module
var nodemailer = require('nodemailer');

//requires body parser module
var bodyParser = require("body-parser");

//puts post data into javascript objects
app.use(bodyParser.urlencoded({ extended: true }));



var transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: 'tagstea@gmail.com',
    pass: 'tag713!!'
  }
});

//static directories for html,image, and css files
app.use(express.static(__dirname+'/views'));
app.use(express.static(__dirname+'/public'));
app.use(express.static(__dirname+'/images'));
app.use(express.static(__dirname+'/JS'));

//requires ejs to be used in the rendering of ejs files
app.set('view engine', 'ejs');

const trencryption = require('./JS/trencryption.js');
const firebase = require('firebase');
const admin = require('firebase-admin')
const serviceAccount = require('./ServiceAccountKey.json')
require("firebase/app")
require("firebase/auth")
require("firebase/database")
require("firebase/firestore")
require("firebase/storage")
require("firebase/messaging")
require("firebase/functions")

admin.initializeApp({
	credential: admin.credential.cert(serviceAccount),
	databaseURL: "https://my-awsome-project-cedd0.firebaseio.com"
})



const db = admin.firestore();

const Subjects = db.collection('Subjects');

const Classes = db.collection('Classes');

const Districts = db.collection('Districts');

const Users = db.collection('Users');

const Enrollments = db.collection('Enrollments');

const Questions = db.collection('Questions');

const Teacher_Responses = db.collection('Teacher_Responses');

app.get('/', function(req, res){
	
	res.render("index")
	
});

app.get('/SchoolBoardAccountPage', function(req, res){
	
	getUserAndClassInfo(res, req, function(result){
		if(result.user_data==null){
			res.redirect('/SchoolBoardLogInPage?err='+'no_user')
		}
		else{
			res.render("SchoolBoardAccountPage", result)
		}
	})
});

app.get('/SchoolBoardLogInPage', function(req, res){
	var err = "";
	
	if(req.query && req.query.err){
		err = "There is something wrong with your account. Please contact your SchoolBoard administrator.";
	}
	
	
	res.render('SchoolBoardLogInPage', {err: err})

});

app.get('/classPage', function(req, res){
	
	
	if(req.query && req.query.id){
		var class_id = req.query.id
		getUserInfo(res, req, function(user_data){
			var query = Questions.where("class_id", "==", class_id);
			query.get().then(function(questions){
				var question_info = []
				var question_ids = []
				questions.forEach(function(question){
					var question_data = question.data()
					question_data.id = question.id
					question_data.responses = []
					question_info.push(question_data)
					question_ids.push(question.id)
				})
				getDocumentsByFeature(Teacher_Responses, "question_id", question_ids, [], function(responses){
					responses.forEach(function(response){
						
						question_info.forEach(function(question){
							if(question.id == response.question_id){
								console.log(response)
								question.responses.push(response)
							}
						})
					})
					//keep working here
					console.log(user_data)
					console.log(question_info[0].responses)
					//res.render('classPage',{user_data: user_data, question_info: question_info})
				})
			})
		})
	}
	else{
		res.redirect("/")
	}
	
	
	

});

app.get('/newform', function(req, res){
	
	
	var validity = {district_id: true, username: true, password: true, email: true}
	res.render('newform', validity)

});

app.post('/auth', function(req, res){
	var username = test_input(req.body.username);
	var aPassword = test_input(req.body.password);
	var query = Users.where("username", "==", username).where("password", "==", trencryption.constantEncrypt(aPassword));
	query.get().then(function(resultsOfQuery){
		if(resultsOfQuery.size > 0){
			resultsOfQuery.forEach(function(doc){
				console.log(doc.data())
				res.cookie('user_id', doc.id, {
					httpOnly: true,
					signed: true
					//add maxAge attribute in milliseconds if wanted
				})
			})
			res.redirect('/SchoolBoardAccountPage')
		}
		else{
			res.redirect('/SchoolBoardLogInPage')
		}
	})
})

app.post('/logout', function(req, res){
	res.clearCookie('user_id')
	res.end('')
})

app.post('/signup', function(req, res){
	var username = test_input(req.body.username);
	var aPassword = test_input(req.body.password);
	var first_name = test_input(req.body.first_name);
	var last_name = test_input(req.body.last_name);
	var aStatus = test_input(req.body.status);
	var district_name = test_input(req.body.district_name);
	var email = test_input(req.body.email);
	
	
	
	registerUser(username, aPassword, first_name, last_name, aStatus,district_name, email, function(validity, user_id){
		if(validity.district_id && validity.username && validity.password && validity.email){
			console.log(validity)
			res.cookie('user_id', user_id, {
				httpOnly: true,
				signed: true
				//add maxAge attribute in milliseconds if wanted
			})
			res.redirect('/SchoolBoardAccountPage')
		}
		else{
			res.render('newform', validity)
		}
		
	})
})

app.get('/cookiecheckstart', function(req, res){
	if(req.signedCookies.user_id){
		res.redirect('SchoolBoardAccountPage')
	}
	else{
		res.redirect('SchoolBoardLogInPage')
	}
});



//the server is listening on port 3000 for connections
app.listen(3000, function () {
  console.log('Example app listening on port 3000!')
  
});

/*// Add a new document with a generated id.
var addDoc = db.collection('Subjects').add({
	subject_name: 'History'
  
}).then(function(ref) {
	var addDoc = db.collection('Classes').add({
		class_name: '20th Century',
		subject_id: ref.id
	})
 
});

var algebraClass= Classes.where("class_name","==","Algebra")
algebraClass.get().then(function(querySnapshot) {
  querySnapshot.forEach(function(doc) {
		Subjects.doc(doc.data().subject_id).get().then(function(theSubject){
			console.log(theSubject.data().subject_name)
		})
		
  });
});

checkIfExists(Classes, "class_name", "20th_Century",function(result){
	console.log(result)
})*/



var query = Subjects.where("subject_name", "==", "Math");
checkIfExists(query,function(result){
	if(!result){
		insertSubject("Math")
	}
})

var query = Districts.where("district_name", "==", "157c");
checkIfExists(query,function(result){
	if(!result){
		insertDistrict("157c")
	}
})



/*var query = Districts.where("district_name", "==", "157c");
getIds(query,function(district_ids){
	registerUser("tlyke", "Monkey713!", "Trenton", "Lyke", "student",district_ids[0], "tlyke@imsa.edu", function(uniqueness){
		console.log(uniqueness)
	})
})*/

var query = Users.where("username", "==", "tlyke");
getIds(query,function(user_ids){
	var query = Classes.where("class_name", "==", "Algebra II");
	getIds(query,function(class_ids){
		console.log(class_ids)
		var query = Enrollments.where("class_id", "==", class_ids[0]).where("user_id", "==", user_ids[0]);
		checkIfExists(query,function(result){
			if(!result){
				insertEnrollment(class_ids[0],user_ids[0])
			}
		})
	})
})
			

var query = Classes.where("class_name", "==", "Algebra II");
checkIfExists(query,function(result){
	
	if(!result){
		var query = Subjects.where("subject_name", "==", "Math");
		getIds(query,function(subject_ids){
			var query = Districts.where("district_name", "==", "157c");
			getIds(query,function(district_ids){
				insertClass("Algebra II",subject_ids[0], district_ids[0])
			})
		})
	}
})



//insertSubject("Math")
//insertClass("Algebra I","1")
function insertSubject(subject_name){
	Subjects.add({
		subject_name: subject_name
	});
}

function insertDistrict(district_name){
	Districts.add({
		district_name: district_name
	});
}

function insertClass(class_name, subject_id, district_id){
	Classes.add({
		class_name: class_name,
		subject_id: subject_id,
		district_id: district_id
	});
}

function insertEnrollment(class_id, user_id){
	Enrollments.add({
		class_id: class_id,
		user_id: user_id
	});
}

function insertUser(username, aPassword, first_name, last_name, aStatus,district_id, email, callback){
	Users.add({
		username: username,
		password: trencryption.constantEncrypt(aPassword),
		first_name: first_name,
		last_name: last_name,
		status: aStatus,
		district_id: district_id,
		email, email
	}).then(ref => {
  callback(ref.id);
});
}

function registerUser(username, aPassword, first_name, last_name, aStatus,district_name, email, callback){
	var validity = {district_id: false, username: false, password: false, email: false}
	var query = Districts.where("district_name", "==", district_name);
	getIds(query, function(ids){
		if(ids[0]){
			validity.district_id = true;
		}
		var query = Users.where("username", "==", username);
		checkIfExists(query,function(usernameExists){
			validity.username = !usernameExists;
			var query = Users.where("password", "==", trencryption.constantEncrypt(aPassword));
			checkIfExists(query,function(passwordExists){
				validity.password = !passwordExists;
				var query = Users.where("email", "==", email);
				checkIfExists(query,function(emailExists){
					validity.email = !emailExists;
					if(validity.district_id && validity.username && validity.password && validity.email){
						insertUser(username, aPassword, addslashes(first_name), addslashes(last_name), aStatus,ids[0], email, function(id){
							callback(validity, id)
						})
						
					}
					else{
						callback(validity, '')
					}
				})
			})
			
		})
	})
}
function checkIfExists(query, callback){
	query.get().then(function(resultsOfQuery){
		if(resultsOfQuery.size > 0){
			callback(true);
		}
		else{
			callback(false);
		}
	})
}

function getIds(query, callback){
	
	query.get().then(function(resultsOfQuery){
		var ids = []
		resultsOfQuery.forEach(function(doc){
			ids.push(doc.id)
		})
		callback(ids)
	})
}

function getDocumentsByID(collection, ids, documents, callback){
	if(ids.length > 0){
		collection.doc(ids[0]).get().then(doc => {
			var docData = doc.data()
			docData.id = ids[0];
			documents.push(docData)
			ids.shift()
			return getDocumentsByID(collection, ids, documents, callback)
		})
	}
	else{
		callback(documents);
	}
}

function getDocumentsByFeature(collection, feature_title, features, documents, callback){
	if(features.length > 0){
		
		collection.where(feature_title,'==',features[0]).get().then(function(resultsOfQuery){
			resultsOfQuery.forEach(function(doc){
			var docData = doc.data()
			
			documents.push(docData)
			features.shift()
			
			})
			return getDocumentsByFeature(collection, feature_title, features, documents, callback)
		})
	}
	else{
		callback(documents);
	}
}

function test_input(data) {
	data = data.trim();
	data = stripslashes(data);
	data = htmlspecialchars(data);
	return data;
}

function addslashes(str) {
    str = str.replace(/\\/g, '\\\\');
    str = str.replace(/\'/g, '\\\'');
    str = str.replace(/\"/g, '\\"');
    str = str.replace(/\0/g, '\\0');
    return str;
}
 
function stripslashes(str) {
    str = str.replace(/\\'/g, '\'');
    str = str.replace(/\\"/g, '"');
    str = str.replace(/\\0/g, '\0');
    str = str.replace(/\\\\/g, '\\');
    return str;
}

function htmlspecialchars(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}
function getUserInfo(res, req, callback){
	if(req.signedCookies.user_id){
		var user_id = req.signedCookies.user_id;
		Users.doc(user_id).get().then(doc => {
			if (doc.exists) {
				var user_data = doc.data();
				user_data.first_name = stripslashes(user_data.first_name)
				user_data.id = user_id
				callback(user_data)		
			} else {
				callback(null)
			}
		})
	}
	else {		
		callback(null)		
	}
}
function getUserAndClassInfo(res, req, callback){
	getUserInfo(res, req, function(user_data){
				if(user_data != null){
				user_id = user_data.id ;
				Enrollments.where('user_id','==',user_id).get().then(function(resultsOfQuery){
					if(resultsOfQuery.size > 0){
						var ids = [];
						resultsOfQuery.forEach(function(doc){
							ids.push(doc.data().class_id)
						})
						
						var documentarray = []
						getDocumentsByID(Classes, ids, documentarray, function(documents){
							callback({user_data: user_data, class_documents: documents})
							
						})
					}
					else{
						callback({user_data: user_data, class_documents: [{class_name: "none", id:null}]})
					}
				})		
				}
				else{
					callback({user_data: null, class_documents: [{class_name: "none", id:null}]})
				}
		})
	
}







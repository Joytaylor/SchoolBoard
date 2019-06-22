
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

app.get('/', function(req, res){
	
	res.render("index")
	
});

app.get('/SchoolBoardAccountPage', function(req, res){
	
	if(req.signedCookies.user_id){
		var user_id = req.signedCookies.user_id;
		console.log(user_id)
		Users.doc(user_id).get().then(doc => {
			if (doc.exists) {
				var user_data = doc.data();
					user_data.first_name = stripslashes(user_data.first_name)
			Enrollments.where('user_id','==',user_id).get().then(function(resultsOfQuery){
				if(resultsOfQuery.size > 0){
					var ids = [];
					resultsOfQuery.forEach(function(doc){
						ids.push(doc.data().class_id)
					})
					
					var documentarray = []
					getDocumentsByID(Classes, ids, documentarray, function(documents){
						res.render("SchoolBoardAccountPage", {user_data: user_data, class_documents: documents})
					})
				}
				else{
					
					res.render("SchoolBoardAccountPage", {user_data: user_data, class_documents: [{class_name: "none"}]})
				}
			})		
				
			} else {
				var err = "no user";
				res.redirect('/SchoolBoardLogInPage?err='+err)
			}
		})
	}
	else {
				var err = "no cookies";
				res.redirect('/SchoolBoardLogInPage?err='+err)
			}
});

app.get('/SchoolBoardLogInPage', function(req, res){
	var err = "";
	
	if(req.query && req.query.err){
		err = "There is something wrong with your account. Please contact your SchoolBoard administrator.";
	}
	
	
	res.render('SchoolBoardLogInPage', {err: err})

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
			documents.push(doc.data())
			ids.shift()
			return getDocumentsByID(collection, ids, documents, callback)
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








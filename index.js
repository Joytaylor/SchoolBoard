//Express
var express = require('express')
var app = express()

//Marko
var isProduction = process.env.NODE_ENV === "production";

require("marko/node-require").install();
var markoExpress = require("marko/express");
app.use(markoExpress());

var fs = require("fs");



//Cookies
var cookieParser = require('cookie-parser')
const cookieEncrypter = require('cookie-encrypter')
const secretKey = 'kjfs9032fsb389d0s0brwe0ren32iqn3'
app.use(cookieParser(secretKey))
app.use(cookieEncrypter(secretKey))

//requires nodemailer module
var nodemailer = require('nodemailer')

//requires body parser module
var bodyParser = require("body-parser")

//puts post data into javascript objects
app.use(bodyParser.urlencoded({ extended: true }))

var transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
        user: 'tagstea@gmail.com',
        pass: 'tag713!!'
    }
})

//static directories for html,image, and css files
app.use(express.static(__dirname + '/views'))
app.use(express.static(__dirname + '/public'))
app.use(express.static(__dirname + '/images'))
app.use(express.static(__dirname + '/JS'))
app.use(express.static(__dirname + '/anime-master/lib'))
app.use(express.static(__dirname + '/components'))

//requires ejs to be used in the rendering of ejs files
app.set('view engine', 'ejs')

const trencryption = require('./JS/trencryption.js')
const firebase = require('firebase')
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

//Initializing Firebase references
const db = admin.firestore()
const Subjects = db.collection('Subjects')
const Classes = db.collection('Classes')
const Schools = db.collection('Schools')
const Users = db.collection('Users')
const Questions = db.collection('Questions')
const Teacher_Responses = db.collection('Teacher_Responses')

//Marko Components
var QuestionComp = require("./question.marko")

app.get('/', (req, res) => {
    res.render("index")
})

app.get('/newform', (req, res) => {
    var validity = { school_id: true, username: true, password: true, email: true }
    res.render('newform', validity)
})

app.post('/signup', (req, res) => {
    //Taking all of the info from the form
    var username = test_input(req.body.username)
    var aPassword = test_input(req.body.password)
    var first_name = test_input(req.body.first_name)
    var last_name = test_input(req.body.last_name)
    var aStatus = test_input(req.body.status)
    var school_name = test_input(req.body.school_name)
    var email = test_input(req.body.email)

    //registering the user
    //this logic is wrong, lets the user log in before checking for validity, i think?
    registerUser(username, aPassword, first_name, last_name, aStatus, school_name, email, function(validity, user_id) {
        if (validity.school_id && validity.username && validity.password && validity.email) {
            res.cookie('user_id', user_id, {
                httpOnly: true,
                signed: true
                    //add maxAge attribute in milliseconds if wanted
            });
            res.cookie("animate", true, {
                httpOnly: true,
                signed: true,
                overwrite: true
            });

            res.redirect('/accountPageAnim')
        } else {
            res.render('newform', validity)
        }
    })
})

app.get('/SchoolBoardLogInPage', (req, res) => {
    var err = ""
    if (req.query && req.query.err) {
        err = "There is something wrong with your account. Please contact your SchoolBoard administrator."
        res.render('SchoolBoardLogInPage', { err: err })
    }
    res.render('SchoolBoardLogInPage')
})

app.post('/auth', (req, res) => {
    var username = test_input(req.body.username)
    var aPassword = test_input(req.body.password)
    var query = Users.where("username", "==", username).where("password", "==", trencryption.constantEncrypt(aPassword))
    query.get().then(function(resultsOfQuery) {
        if (resultsOfQuery.size > 0) {
            resultsOfQuery.forEach(function(doc) {
                res.cookie('user_id', doc.id, {
                    httpOnly: true,
                    signed: true
                        //add maxAge attribute in milliseconds if wanted
                });
                /*
                res.cookie("animate", true, {
                    httpOnly: true,
                    signed: true,
                    overwrite: true
                });*/
            })
            res.redirect('/account')
        } else {
            res.redirect('/SchoolBoardLogInPage')
        }
    })
})

app.get('/cookiecheckstart', (req, res) => {
    if (req.signedCookies.user_id) {
        res.redirect('/account')
    } else {
        res.redirect('/SchoolBoardLogInPage')
    }
})

app.get("/account", (req, res) => {
    var classData = []
    getUserInfo(res, req, function(userData) {
        var i = 0
        var numOfClasses = userData.classes.length
        var animate = req.signedCookies.animate;
        userData.classes.forEach(function(class_id) {
            Classes.doc(class_id).get().then(doc => {
                var class_data = doc.data()
                class_data.id = class_id
                classData.push(class_data)
                i++
                if (numOfClasses == i) {
                    //Eventually figure out toggling animation via cookies
                    /*res.cookie("animate", false, {
                        httpOnly: true,
                        signed: true,
                        overwrite: true
                    });*/
                    res.render("accountPage", { classData, userData })
                }
            })
        })
    })
})

app.post('/logout', (req, res) => {
    res.clearCookie('user_id', {
        httpOnly: true,
        signed: true
    })
    res.clearCookie('animate', {
        httpOnly: true,
        signed: true
    })
    res.end('')
})

app.get('/classPage', (req, res) => {
    if (req.query && req.query.id) {
        var class_id = req.query.id;
        getUserInfo(res, req, user_data => {
            getClassInfo(class_id, class_data => {
                if (class_data != null) {
                    var currentTime = new Date();
                    //Query probably not working properly
                    var query = Questions.where("class_id", "==", class_id)
                    query.get().then(questions => {
                        var question_info = []
                        var question_ids = []
                        questions.forEach(question => {
                            var question_data = question.data()
                            question_data.id = question.id
                            question_data.responses = []
                            question_data.date_of_ask = question_data.date_of_ask.toDate().toLocaleString('en-US', { month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true })
                            question_info.push(question_data)
                            question_ids.push(question.id)
                        })
                        getDocumentsByFeature(Teacher_Responses, "question_id", question_ids, [], responses => {
                            responses.forEach(response => {
                                    question_info.forEach(question => {
                                        if (question.id == response.question_id) {
                                            question.responses.push(response)
                                        }
                                    })
                                })
                                //keep working here
                            if (user_data == null) {
                                res.redirect('/SchoolBoardLogInPage?err=' + 'no_user')
                            } else {
                                //res.marko(QuestionComp, { question_info: question_info })
                                res.render('classPage', { class_data: class_data, user_data: user_data, question_info: question_info })
                            }
                        })
                    })
                } else {
                    res.redirect('/accountPage?err=' + 'no_class')
                }
            })
        })
    } else {
        res.redirect("/")
    }
})

app.post('/vote', (req, res) => {
    if (req.signedCookies.user_id) {
        var question_id = req.body.question_id
        var query = Questions.doc(question_id)
        query.get().then(doc => {
            var votes = doc.data().votes
            query.update({
                votes: votes + 1,
                voter_ids: admin.firestore.FieldValue.arrayUnion(req.signedCookies.user_id)
            })
        })
    }
})

app.post("/timeQuery", (req, res) => {
    //How this works (inefficient method, will most likely slow things down in the long run)
    //Queries for all the questions in database for class
    //Filters all questions via ask time/vote count
    //Returns them
    //Did this because I couldn't figure out how to only query for questions in specific date yet
    var queryTypes = req.body.queryType;
    var classID = req.body.classID;
    if (classID) {
        let query = Questions.where("class_id", "==", classID).orderBy("date_of_ask", "desc");
        query.get().then(questions => {
            var question_info = [];
            questions.forEach(question => {
                let question_data = question.data();
                question_data.id = question.id;
                question_info.push(question_data);
            });

            let currentTime = new Date().getDate();
            let endTime = new Date();
            //Sorting by query type
            queryTypes.forEach(queryType => {
                switch (queryType) {
                    case "thisWeek":
                        endTime = currentTime - 7;
                    case "thisMonth":
                        endTime = currentTime - 30;
                        break;
                    case "mostVoted":
                        question_info.sort((a, b) => -(a.votes - b.votes));
                        break;
                        //Add feature for "this semester"
                        //Add feature for recent answers
                }
            });
            //Filtering questions by time
            var question_info = question_info.filter(question => {
                return question.date_of_ask.toDate() < endTime;
            });

            //Rendering question view with user's data via Marko
            var user_id = req.signedCookies.user_id;
            var query = Users.doc(user_id);
            query.get().then(user_data => {
                user_data = user_data.data();
                user_data.id = user_id;
                question_info = question_info.map(question => {
                    question.date_of_ask = question.date_of_ask.toDate().toLocaleString('en-US', { month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', hour12: true });
                    return question;
                })
                if (question_info.length) {
                    var renderedQuestions = QuestionComp.renderToString({ question_info: question_info, user_data: user_data });
                    res.send(renderedQuestions);
                } else {
                    res.send("<p class='null'>No questions available for these filters yet.</p>")
                }

            });
        });
    }
})

//NFD: for some reason, multiple hashtags is registered as only one.
app.post('/addQuestion', (req, res) => {
    if (req.signedCookies.user_id) {
        var user_id = req.signedCookies.user_id
        var class_id = req.body.class_id
        var question = req.body.question
        var hashtags = req.body.hashtag
        insertQuestion(user_id, class_id, question, hashtags, () => {
            res.redirect('/classPage?id=' + class_id)
        })
    }
})

app.post('/addAnswer', (req, res) => {
    if (req.signedCookies.user_id) {
        var user_id = req.signedCookies.user_id
        var class_id = req.body.class_id
        var question_id = req.body.question_id
        var teacher_response = req.body.teacher_response
        insertTeacher_Response(user_id, question_id, teacher_response, () => {
            res.redirect('/classPage?id=' + class_id)
        })
    }
})

app.listen(3000, function() {
    console.log('listening on port 3000')
})


//Functions
function sortByVotes(responses) {
    var swapp
    var lastIndex = responses.length - 1
    var newResponses = responses
    do {
        swapp = false
        for (var i = 0; i < lastIndex; i++) {
            if (newResponses[i].votes < newResponses[i + 1].votes) {

                var temp = newResponses[i]
                newResponses[i] = newResponses[i + 1]
                newResponses[i + 1] = temp
                swapp = true
            }
        }
        lastIndex--
    } while (swapp)
    return newResponses
}

function insertQuestion(user_id, class_id, question, hashtags, callback) {
    Questions.add({
        class_id: class_id,
        date_of_ask: new Date(),
        user_id: user_id,
        hashtags: hashtags,
        question_text: question,
        voter_ids: [],
        votes: 0
    }).then(() => {
        callback()
    })
}

function insertTeacher_Response(user_id, question_id, teacher_response, callback) {
    Teacher_Responses.add({
        user_id: user_id,
        question_id: question_id,
        teacher_response: teacher_response,
        date_of_ask: new Date(),
        votes: 0

    }).then(function() {
        callback()
    })
}

function insertSchool(school_name) {
    Schools.add({
        school_name: school_name
    })
}

function insertClass(class_code, class_name, class_section, class_teacher, school_id) {
    Classes.add({
        class_code: class_code,
        class_name: class_name,
        class_section: class_section,
        class_teacher: class_teacher,
        school_id: school_id
    })
}

function insertUser(username, aPassword, first_name, last_name, aStatus, school_id, email, callback) {
    Users.add({
        username: username,
        password: trencryption.constantEncrypt(aPassword),
        first_name: first_name,
        last_name: last_name,
        status: aStatus,
        school_id: school_id,
        email: email
    }).then(ref => {
        callback(ref.id)
    })
}

function registerUser(username, aPassword, first_name, last_name, aStatus, school_name, email, callback) {
    var validity = { school_id: false, username: false, password: false, email: false }
    var query = Schools.where("school_name", "==", school_name)
        //Setting password as true (check again)
    validity.password = true
    getIds(query, function(ids) {
        if (ids[0]) {
            validity.school_id = true
        }
        var query = Users.where("username", "==", username)
        checkIfExists(query, function(usernameExists) {
            validity.username = !usernameExists
            var query = Users.where("email", "==", email)
            checkIfExists(query, function(emailExists) {
                validity.email = !emailExists
                if (validity.school_id && validity.username && validity.password && validity.email) {
                    //inserting the user here
                    insertUser(username, aPassword, addslashes(first_name), addslashes(last_name), aStatus, ids[0], email, function(id) {
                            callback(validity, id)
                        })
                        //redirecting the user to enrollment page
                } else {
                    callback(validity, '')
                }
            })
        })
    })
}

function checkIfExists(query, callback) {
    query.get().then(function(resultsOfQuery) {
        if (resultsOfQuery.size > 0) {
            callback(true)
        } else {
            callback(false)
        }
    })
}

function checkIfEnrolled(user_id, class_id, callback) {
    var query = Enrollments.where("user_id", "==", user_id).where("class_id", "==", class_id)
    checkIfExists(query, function(isEnrolled) {
        callback(isEnrolled)
    })
}

function getIds(query, callback) {
    query.get().then(function(resultsOfQuery) {
        var ids = []
        resultsOfQuery.forEach(function(doc) {
            ids.push(doc.id)
        })
        callback(ids)
    })
}

function getDocumentsByID(collection, ids, documents, callback) {
    if (ids.length > 0) {
        collection.doc(ids[0]).get().then(doc => {
            var docData = doc.data()
            docData.id = ids[0]
            documents.push(docData)
            ids.shift()
            return getDocumentsByID(collection, ids, documents, callback)
        })
    } else {
        callback(documents)
    }
}

function getDocumentsByFeature(collection, feature_title, features, documents, callback) {
    if (features.length > 0) {

        collection.where(feature_title, '==', features[0]).get().then(function(resultsOfQuery) {
            if (resultsOfQuery.size > 0) {
                resultsOfQuery.forEach(function(doc) {

                    var docData = doc.data()

                    documents.push(docData)

                })
            }
            features.shift()
            return getDocumentsByFeature(collection, feature_title, features, documents, callback)
        })
    } else {
        callback(documents)
    }
}

function test_input(data) {
    data = data.trim()
    data = stripslashes(data)
    data = htmlspecialchars(data)
    return data
}

function addslashes(str) {
    str = str.replace(/\\/g, '\\\\')
    str = str.replace(/\'/g, '\\\'')
    str = str.replace(/\"/g, '\\"')
    str = str.replace(/\0/g, '\\0')
    return str
}

function stripslashes(str) {
    str = str.replace(/\\'/g, '\'')
    str = str.replace(/\\"/g, '"')
    str = str.replace(/\\0/g, '\0')
    str = str.replace(/\\\\/g, '\\')
    return str
}

function htmlspecialchars(text) {
    var map = {
        '&': '&amp',
        '<': '&lt',
        '>': '&gt',
        '"': '&quot',
        "'": '&#039'
    }

    return text.replace(/[&<>"']/g, function(m) { return map[m] })
}

function getUserInfo(res, req, callback) {
    if (req.signedCookies.user_id) {
        var user_id = req.signedCookies.user_id
        Users.doc(user_id).get().then(doc => {
            if (doc.exists) {
                var user_data = doc.data()
                user_data.first_name = stripslashes(user_data.first_name)
                user_data.id = user_id
                callback(user_data)
            } else {
                callback(null)
            }
        })
    } else {
        callback(null)
    }
}

function getClassInfo(class_id, callback) {
    Classes.doc(class_id).get().then(doc => {
        if (doc.exists) {
            var class_data = doc.data()
            class_data.id = class_id
            callback(class_data)
        } else {
            callback(null)
        }
    })
}

function getUserAndClassInfo(res, req, callback) {
    getUserInfo(res, req, function(user_data) {
        if (user_data != null) {
            user_id = user_data.id
            classes = user_data.classes
            if (classes.length > 0) {
                var documentarray = []
                getDocumentsByID(Classes, classes, documentarray, function(documents) {
                    callback({ user_data: user_data, class_documents: documents, err: '' })
                })
            } else {
                callback({ user_data: user_data, class_documents: [{ class_name: "none", id: null }], err: '' })
            }
        } else {
            callback({ user_data: null, class_documents: [{ class_name: "none", id: null }], err: '' })
        }
    })
}
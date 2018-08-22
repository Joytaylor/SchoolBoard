
var fs = require('fs')
var courseName = 'organic';
var teachers = 'dr.white';
fs.readFile("base.html", 'utf8', function (err,data) {
  if (err) {
    return console.log(err);
  }
  var data1 =data.split('replacement').join(courseName);
  var data2 =
   data1.split('dr.coolness').join(teachers);
  var result = data2.split('replacementQuestionPage.html') .join(courseName+'QuestionPage.html');

  fs.writeFile(courseName + ".html", result, 'utf8', function (err) {
     if (err) return console.log(err);
  });
});

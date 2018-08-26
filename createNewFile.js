
var fs = require('fs')
var courseName = 'Stats';
var teachers = 'Trainor';
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
  fs.readFile("basequestion.html", 'utf8', function(err,data){
    if(err){
      return consle.log(err);
    }
    var result = data.split('replacement').join(courseName);
  fs.writeFile(courseName + "questionPage.html", result, 'utf8', function(err){
    if(err) return console.log(err);
  });
});

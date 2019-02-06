
var fs = require('fs');
var courseName = 'IN2';
var teachers = 'Dr. Page';
fs.readFile("stats.php", 'utf8', function (err,data) {
  if (err) {
    return console.log(err);
  }
  var data1 =data.split('Stats').join(courseName);
  var data2 =
   data1.split('Trainer').join(teachers);
  var result = data2.split('StatsquestionPage.html') .join(courseName+'QuestionPage.html');

  fs.writeFile(courseName + ".php", result, 'utf8', function (err) {
     if (err) return console.log(err);
  });
  });
  fs.readFile("StatsquestionPage.html", 'utf8', function(err,data){
    if(err){
      return consle.log(err);
    }
    var result = data.split('Stats').join(courseName);
  fs.writeFile(courseName + "questionPage.html", result, 'utf8', function(err){
    if(err) return console.log(err);
  });
});

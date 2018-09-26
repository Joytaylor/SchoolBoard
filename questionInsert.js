var submit = document.getElementById('submit');
var fs = require('fs');
submit.onclick( function(){
  fs.readFile("stats.html", "utf-8", function (err,data) {
    if (err) {
      return console.log(err);
    }
    var result = data.split('<h2>No questions asked for this class yet, check again soon!</h2>').join(' ');
    var question = data.replace("<div class = 'innerContainer'", "<div class = 'innerContainer'" + submit );
})})

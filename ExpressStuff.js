var app = require('express')(),
server = require('http').createServer(app),
io = require('socket.io').listen(server),
ent = require('ent'),
fs = require('fs');

const { body,validationResult } = require('express-validator/check');
const { sanitizeBody } = require('express-validator/filter');


app.get('/', function (req, res) {
   res.sendFile( __dirname + "/" + "index.html" );
})
app.get('/stats.html', function (req, res) {
   console.log("Got a GET request for the homepage");
   res.sendFile( __dirname + "/" + "stats.html" );
})
app.get('/StatsQuestionPage.html', function (req, res) {
   console.log("Got a GET request for the homepage");
   res.sendFile( __dirname + "/" + "StatsQuestionPage.html" );
});
io.sockets.on('connection', function(socket, username){
  socket.on('question', function( message){
    message = ent.encode(message);
    console.log("it worked");
    socket.broadcast.emit('question', {message:message});
  });
});


var setup= app.listen(8080, function () {
   var host = setup.address().address
   var port = setup.address().port

   console.log("Example app listening at http://%s:%s", host, port)
})

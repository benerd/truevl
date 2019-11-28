


// var express = require('express');
// var app = express();

var server = require('http').createServer(app);
var io = require('socket.io')(server, { wsEngine: 'ws' });


var express = require('express');
var app     = express();
// var server  = require('http').createServer(app);
// var io      = socket.listen( server );
var port    = 3000;

var count = 0;

var $ipsConnected = [];

server.listen(port, function () {
  console.log('Server listening at port %d', port);
});


io.on('connection', function (socket) {

  socket.on( 'new_count_message', function( data ) {
    
    io.sockets.emit( 'new_count_message', { 
    	new_count_message: data.new_count_message,
      sid:data.sid
    });
  });

  socket.on( 'update_count_message', function( data ) {
    io.sockets.emit( 'update_count_message', {
    	update_count_message: data.update_count_message 
    });
  });

  socket.on( 'new_message', function(data){
    io.sockets.emit( 'new_message', {
         message: data.message,
         uid1: data.uid1,
         uid2: data.uid2,
         fimg: data.fimg,
         imgUrl:data.imgUrl,
         post_title:data.post_title,
         short_des:data.short_des
    });

    console.log(data);
  });

  socket.on( 'send_attachment', function(data){
    io.sockets.emit( 'send_attachment', {
         attachment: data.attachment,
         uid1: data.uid1,
         fimg:data.fimg
    });
     console.log("zdcnbczbd"+data);
  });
   
  
});
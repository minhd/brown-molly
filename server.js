var server = require('http').Server();
var io = require('socket.io')(server);

var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('test-channel');
redis.on('message', function(channel, message){
    console.log('Message received');
    message = JSON.parse(message);

    //test-chanel:userSignedUp
    var event = channel+":"+message.event;
    console.log(event, message.data);
    io.emit(event, message.data);
});

io.on('connection', function(socket) {
    console.log('A client connects.')

    socket.on('disconnect', function(){
        console.log( "A client disconnected" );
    });

    socket.on('chat.message', function(message) {
        console.log('New message: '+message);
        io.emit('chat.message', message);
    });
});


server.listen(3000);
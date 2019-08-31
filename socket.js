var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();

redis.subscribe('test-channel', function () {
    console.log('Channel subscribe...')
});

redis.on('message', function (channel, message) {

    console.log(channel, message);

    // message = JSON.parse(message);

    // io.emit(channel + ':' + message.event, message.data);

});

server.listen(3000, function () {
    console.log('listening on *:3000');
});





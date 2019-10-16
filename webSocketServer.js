"use strict";

require("dotenv").config();
var server = require("http").createServer(handler);
var io = require("socket.io")(server, {
    cookie : false
});

var redisPort = process.env.REDIS_PORT;
var redisHost = process.env.REDIS_HOST;
var broadCastPort = process.env.BROADCAST_PORT;
var connectCounter = 0;

try {

    var Redis = require("ioredis");
    var redis = new Redis(redisPort, redisHost, {tls: {}});
    console.log("Connect to Redis server on port"+ redisPort);
    redis.subscribe("user-appointments");

}catch (err) {
    console.log('Redis connection failed to server');
    throw new Error(err);
}

//connecting to server
server.listen(broadCastPort, function() {
    console.log("server started listening on: " + broadCastPort);
});

//redis subscribing channels
redis.psubscribe("*", function(err, count) {
    console.log("channel subscribed");
});

//socket io connection establishing
try {
    io.on("connection", function (socket) {
        console.log("user no "+connectCounter+" connected");

        // Disconnect listener
        socket.on("disconnect", function() {
            console.log("Client disconnected.");
            connectCounter--;
        });
    });


}catch (err) {
    console.log('user connection failed');
    throw new Error(err);
}

function handler(req, res) {
    res.writeHead(200);
    res.end("");
}

//redis emiting the mmessage
redis.on("pmessage", function(subscribed, channel, message) {
    console.log("published message fetched from redis");
    message = JSON.parse(message);
    io.emit(channel + ":" + message.event);
});

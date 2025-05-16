const { createServer } = require("http");
const { Server } = require('socket.io');
const httpServer = createServer();
let onlineUsers = {};

const io = new Server(httpServer, {
    cors: {
        origin: "http://localhost:8000"
    }
});

io.on('connection', (socket) => {
    const user_id = socket.handshake.query.user_id;
    onlineUsers[user_id] = socket.id;
    io.emit('online-users', {onlineUsers: Object.keys(onlineUsers)});

    socket.on('private-message', ({text, from, to}) =>
    {
        const socket_id = onlineUsers[to];
        socket.to(socket_id).emit('private-message', {text, from});
    });

    socket.on('disconnect', () => {
        const user_id = Object.keys(onlineUsers).find(key => onlineUsers[key] == socket.id);
        delete(onlineUsers[user_id]);
        socket.broadcast.emit('online-users', {onlineUsers: Object.keys(onlineUsers)});
    })
});

httpServer.listen(3000);
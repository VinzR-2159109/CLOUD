<!doctype html>
<html>
<head>
    <title>WebSocket Client</title>
</head>
<body>
    <h1>WebSocket Client</h1>
    <button onclick="sendMsg()">Activate Safety Alert</button>
    <div id="messages"></div>

    <script>
        const socket = new WebSocket("ws://localhost:3000");

        socket.addEventListener("message", function(event) {
            const messagesDiv = document.getElementById("messages");
            const message = document.createElement("p");
            message.innerText = event.data;
            messagesDiv.appendChild(message);
        });
        

        function sendMsg() {
            if (socket.readyState == WebSocket.OPEN) {
                socket.send(new Date());
                console.log("msg sent");
            }
        }
    </script>
</body>
</html>

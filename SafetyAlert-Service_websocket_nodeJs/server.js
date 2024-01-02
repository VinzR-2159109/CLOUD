const WebSocket = require('ws');
const http = require('http');

const server = http.createServer();
const wss = new WebSocket.Server({ server });

wss.on('connection', (ws) => {
  console.log('Client connected');

  ws.on('message', (message) => {
    console.log(`Received: ${message}`);
  
    if (message === 'activateSafetyAlert') {
        wss.clients.forEach((client) => {
            if (client.readyState === WebSocket.OPEN) {
              client.send('Safety Alert: Prolonged inactivity detected!');
            }
        });
    }
  });

  ws.on('close', () => {
    console.log('Client disconnected');
  });
});

server.listen(3000, () => {
  console.log('WebSocket server is listening on port 3000');
});

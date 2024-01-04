const WebSocket = require('ws');
const http = require('http');

const server = http.createServer();
const wss = new WebSocket.Server({ server });

let timer;
let safetyAlertActive = false;
let lastKnownLocation = { latitude: 0, longitude: 0 };

server.listen(3000, () => {
  console.log('WebSocket server is listening on port 3000');
});

wss.on('connection', (ws) => {
  console.log('Client connected');

  ws.on('message', (message) => {
    try {
      const parsedMessage = JSON.parse(message);
      handleMessage(parsedMessage, ws.clients);
    } catch (error) {
      console.error('Error parsing JSON:', error);
    }
  });

  ws.on('close', () => {
    console.log('Client disconnected');
  });
});

function handleMessage(parsedMessage, clients) {
  switch (parsedMessage.type) {
    case 'activateSafetyAlert':
      console.log('Safety Alert Activated');
      safetyAlertActive = true;
      break;
    case 'safetyAlert':
      resetTimer();
      console.log('Safety Alert received.');
      break;
    case 'deactivateSafetyAlert':
      console.log('Safety Alert Deactivated');
      safetyAlertActive = false;
      break;
    case 'locationUpdate':
      console.log('Location Update received:', parsedMessage.location);
      lastKnownLocation = parsedMessage.location;
      break;
    case 'SOS':
      sendHelp('SOS signal received. Sending help to:');
      break;
    default:
      console.log('Unknown message type:', parsedMessage.type);
  }
}

function resetTimer() {
  if (timer) {
    clearTimeout(timer);
  }

  timer = setTimeout(checkSafetyAlert, 5000);
}

function checkSafetyAlert() {
  if (safetyAlertActive) {
    sendHelp('No safety alert received. Sending help to:');
  }
}

function sendHelp(message) {
  wss.clients.forEach((client) => {
    if (client && client.readyState === WebSocket.OPEN) {
      client.send(message + JSON.stringify(lastKnownLocation));
    }
  });

  console.log(message + JSON.stringify(lastKnownLocation));
}

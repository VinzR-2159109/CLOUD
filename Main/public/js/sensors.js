//const mqtt = require('mqtt')
var client = mqtt.connect('ws://c38b2e0d43aa445da282c1637c3c0410.s1.eu.hivemq.cloud:8884', {
    username: 'VinzRoosen',
    password: 'cnVlz@QoG2vTTvyO',
    clientId: 'web-client-' + Math.random().toString(16).substr(2, 8)
});

client.on('connect', function () {
    console.log('Connected to MQTT Broker');
    client.subscribe('sensors/#');
});

client.on('message', function (topic, message) {
    console.log('Received message:', topic, message.toString());

    var sensorId = topic.split('/')[1];
    $('#' + sensorId).text(message.toString());
});
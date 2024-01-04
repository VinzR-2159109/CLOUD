var client = mqtt.connect('wss://c38b2e0d43aa445da282c1637c3c0410.s1.eu.hivemq.cloud:8884/mqtt', {
    username: 'VinzRoosen',
    password: 'cnVlz@QoG2vTTvyO',
    clientId: 'web-client-' + Math.random().toString(16).substring(2, 10)
});

const sensorDatasets = {};
var totalSteps = 0;

function createSensorDataset(sensorId, color) {
    return {
        label: sensorId,
        data: [],
        fill: false,
        borderColor: color,
        tension: 0.1
    };
}

function addSensor(sensorId, color) {
    sensorDatasets[sensorId] = createSensorDataset(sensorId, color);

    switch (sensorId) {
        case 'heartbeat':
            heartbeatChart.data.datasets.push(sensorDatasets[sensorId]);
            break;
        case 'steps':
            stepsChart.data.datasets.push(sensorDatasets[sensorId]);
            break;
        case 'gps':
            gpsChart.data.datasets.push(sensorDatasets[sensorId]);
            break;
        case 'barometer':
            barometerChart.data.datasets.push(sensorDatasets[sensorId]);
            break;
        case 'temperature':
            tempChart.data.datasets.push(sensorDatasets[sensorId]);
            break;
    }
}


client.on('connect', function () {
    console.log('Connected to MQTT Broker');
    client.subscribe('sensors/#');
});

//https://www.chartjs.org/docs/latest/charts/line.html
const tempChart = new Chart(document.getElementById('tempChart').getContext('2d'), {
    type: 'line',
    data: {
        datasets: []
    },
});

const gpsChart = new Chart(document.getElementById('gpsChart').getContext('2d'), {
    type: 'scatter',
    data: {
        datasets: [{
            label: 'GPS Data',
            data: [],
            fill: false,
            borderColor: getRandomColor(),
            pointRadius: 5,
        }],
    },
    options: {
        scales: {
            x: {
                type: 'linear',
                position: 'bottom',
                scaleLabel: {
                    display: true,
                    labelString: 'Longitude (Lang)',
                },
            },
            y: {
                type: 'linear',
                position: 'left',
                scaleLabel: {
                    display: true,
                    labelString: 'Latitude (Long)',
                },
            },
        },
    },
});

const barometerChart = new Chart(document.getElementById('barometerChart').getContext('2d'), {
    type: 'bar',
    data: {
        datasets: []
    },
    options: {
        scales: {
            x: {
                display : false,
            },
        },
    },
});

const stepsChart = new Chart(document.getElementById('stepsChart').getContext('2d'), {
    type: "pie",
    data: {
        datasets: [{
            data: [totalSteps, 6000 - totalSteps],
            backgroundColor: [getRandomColor(), 'lightgray'],
        }],
        labels: ['Current Steps', 'Remaining Steps']
    },
    options: {
        rotation: 1 * Math.PI, 
        circumference: 1 * Math.PI,
    }
});


const accelerometerData = {
    labels: ['X', 'Y', 'Z'],
    datasets: [{
      label: 'Accelerometer Data',
      data: [],
      fill: true,
      backgroundColor: 'rgba(75, 192, 192, 0.2)',
      borderColor: 'rgb(75, 192, 192)',
      pointBackgroundColor: 'rgb(75, 192, 192)',
      pointBorderColor: '#fff',
      pointHoverBackgroundColor: '#fff',
      pointHoverBorderColor: 'rgb(75, 192, 192)',
    }]
};

const accelerometerChart = new Chart(document.getElementById('accelerometerChart').getContext('2d'), {
    type: 'radar',
    data: accelerometerData,
    options: {
        elements: {
            line: {
                borderWidth: 3
            }
        }
    },
});


const heartbeatChart = new Chart(document.getElementById('heartbeatChart').getContext('2d'), {
    type: 'line',
    data: {
        datasets: []
    },
    options: {
        scales: {
            x: {
                display : false,
            },
        },
    },
});

client.on('message', function (topic, message) {
    console.log('Received message:', topic, message.toString());

    var sensorId = topic.split('/')[1];
    
    if (!sensorDatasets[sensorId]) {
        addSensor(sensorId, getRandomColor());
    }

    switch (sensorId) {
        case 'accelerometer':
            const [x, y, z] = message.toString().split(',').map(parseFloat);
            accelerometerData.datasets[0].data = [x, y, z];

            $('#accelerometer').text(message.toString());
            accelerometerChart.update();
            break;
        case 'gps':
            const [lang, long] = message.toString().split(',').map(parseFloat);
            gpsChart.data.datasets[0].data.push({ x: lang, y: long });

            $('#gps').text(message.toString());
            gpsChart.update();
            break;
        case 'steps':
            totalSteps += parseInt(message.toString());
            sensorDatasets['steps'].data.push({ x: new Date(), y: totalSteps });
            stepsChart.data.datasets[0].data = [totalSteps, 6000 - totalSteps];

            $('#steps').text(totalSteps);
            stepsChart.update();
            break;
        default:
            sensorDatasets[sensorId].data.push({ x: new Date(), y: parseFloat(message).toString() });

            $('#' + sensorId).text(message.toString());
            heartbeatChart.update();
            tempChart.update();
            barometerChart.update();
    }
});

function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

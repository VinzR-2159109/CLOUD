@include ('header')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sensor.css') }}">

    <title>Sensor Values</title>
</head>

<body>
    <h1>Sensor Values</h1>

    <ul>
        <li><strong>Heartbeat:</strong> <span id="heartbeat">N/A</span></li>
        <li><strong>Steps:</strong> <span id="steps">N/A</span></li>
        <li><strong>GPS:</strong> <span id="gps">N/A</span></li>
        <li><strong>Accelerometer:</strong> <span id="accelerometer">N/A</span></li>
        <li><strong>Barometer:</strong> <span id="barometer">N/A</span></li>
        <li><strong>Temperature:</strong> <span id="temperature">N/A</span></li>
    </ul>

    <div id class="chart-container">
        <canvas id="heartrateChart" width="400" height="200"></canvas>
        <canvas id="heartbeatChart" width="400" height="200"></canvas>
        <canvas id="tempChart" width="400" height="200"></canvas>
        <canvas id="barometerChart" width="400" height="200"></canvas>
        <canvas id="accelerometerChart" width="400" height="200"></canvas>
        <canvas id="gpsChart" width="400" height="200"></canvas>
        <canvas id="stepsChart" width="400" height="200"></canvas>
    </div>
    
    <script type="importmap">{ "imports": { "@urql/core":"https://cdn.jsdelivr.net/npm/@urql/core@4.2.0/+esm" } }</script>
    <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="module" src='js/sensors.js'></script>
</body>

</html>
@include('footer')
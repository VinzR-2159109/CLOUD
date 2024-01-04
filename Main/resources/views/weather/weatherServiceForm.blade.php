<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">

    <link href="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.css" rel="stylesheet">
    <link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">

    <script src="https://api.mapbox.com/mapbox-gl-js/v3.0.1/mapbox-gl.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.min.js"></script>
    <script src="{{ asset('js/weatherMap.js') }}"></script>

    <style>
        body { 
            margin: 0; 
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; 
        }
        button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #map { position: absolute; top: 40px; bottom: 0; width: 100%;}
    </style>

    <title>Weather Service</title>
</head>
<body>

    <form action="{{ url('/weather-service-response') }}" method="post">
        @csrf
        <label for="latitude">Latitude:</label>
        <input type="text" name="latitude" id="latitude" required>
        <label for="longitude">Longitude:</label>
        <input type="text" name="longitude" id="longitude" required>
        <button type="submit">Get Weather</button>
    </form>
    
    <div id='map'></div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/weatherResponse.css') }}">
    <script src="{{ asset('js/weatherClient.js') }}"></script>
    <title>Weather Response</title>
</head>
<body>
    <div id="weather-details">
        <h1>Weather Response</h1>
        <h2>Condition: <span id="condition"></span></h2>
        <h2>Temperature: <span id="temperature"></span> °C</h2>
        <h2>Humidity: <span id="humidity"></span> %</h2>
        <h2>Wind Speed: <span id="wind-speed"></span> m/s</h2>
        <h2>Precipitation: <span id="precipitation"></span> %</h2>
    </div>

    <script>
        var latitude = @json($latitude);
        var longitude = @json($longitude);

        client.getWeatherAtLocation(longitude, latitude, (err, response) => {
            if (err) {
                console.log(err);
            } else {
                console.log(response);
                displayWeatherData(response);
            }
        });

        function displayWeatherData(weatherResponse) {
            var condition = weatherResponse.getCondition();
            var temperature = weatherResponse.getTemperature();
            var humidity = weatherResponse.getHumidity();
            var windSpeed = weatherResponse.getWindspeed();
            var precipitation = weatherResponse.getPrecipitation();

            document.getElementById("condition").textContent = condition;
            document.getElementById("temperature").textContent = temperature;
            document.getElementById("humidity").textContent = humidity;
            document.getElementById("wind-speed").textContent = windSpeed;
            document.getElementById("precipitation").textContent = precipitation;
        }
    </script>

</body>
</html>

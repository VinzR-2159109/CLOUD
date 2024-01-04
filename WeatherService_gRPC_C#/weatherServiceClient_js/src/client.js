const { Location, WeatherRequest, WeatherResponse } = require('./generated/weather_pb.js');
const { WeatherClient } = require('./generated/weather_grpc_web_pb.js');

var grpcClient = {};

grpcClient.getWeatherAtLocation = function (longitude, latitude, callback) {

    var client = new WeatherClient("http://localhost:5051");

    var location = new Location();
    location.setLongitude(longitude);
    location.setLatitude(latitude);

    var weatherRequest = new WeatherRequest();
    weatherRequest.setLocation(location);

    return client.getWeatherAtLocation(weatherRequest, {} , callback);
}

module.exports = grpcClient;
using Grpc.Core;
using weatherService;

namespace weatherService.Services;

public class WeatherServiceImpl : Weather.WeatherBase
{
    private readonly ILogger<WeatherServiceImpl> _logger;

    public WeatherServiceImpl(ILogger<WeatherServiceImpl> logger)
    {
        _logger = logger;
    }

    public override Task<WeatherResponse> getWeatherAtLocation(WeatherRequest request, ServerCallContext context)
    {
        float latitude = request.Location.Latitude;
        float longitude = request.Location.Longitude;

        string condition = (latitude > 0) ? "Sunny" : "Cloudy";

        Random random = new();
        float humidity = (longitude > 0) ? random.Next(50, 100) : random.Next(0, 50);

        float temperature;
        if (longitude > 0 && latitude > 0)
        {
            temperature = random.Next(0, 10);
        }
        else if (longitude < 0 && latitude < 0)
        {
            temperature = random.Next(10, 30);
        }
        else
        {
            temperature = random.Next(0, 30);
        }

        var response = new WeatherResponse
        {
            Condition = condition,
            Temperature = temperature,
            Humidity = humidity,
            WindSpeed = random.Next(0, 10),
            Precipitation = random.Next(0, 100)
        };

        _logger.LogInformation($"Generated weather data for location ({latitude}, {longitude}): {response}");

        return Task.FromResult(response);
    }
}
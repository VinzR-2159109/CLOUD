from weather_pb2 import *
import weather_pb2_grpc
import grpc
import weather_pb2
import weather_pb2_grpc

def get_weather_info():
    with grpc.insecure_channel('localhost:5052') as channel:
        stub = weather_pb2_grpc.WeatherStub(channel)

        # Replace these coordinates with the desired location
        location = weather_pb2.Location(latitude=50.9271, longitude=5.3963)
        request = weather_pb2.WeatherRequest(location=location)

        response = stub.getWeatherAtLocation(request)

        print(f"Weather temperature: {response.temperature} and Weather condition: {response.condition}")
        print(f"Humidity: {response.humidity}, Wind Speed: {response.wind_speed}, Precipitation: {response.precipitation}")

if __name__ == "__main__":
    get_weather_info()

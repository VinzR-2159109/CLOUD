from weather_pb2 import *
import weather_pb2_grpc
import grpc

def run():
    with grpc.insecure_channel('localhost:50051') as channel:
        stub = weather_pb2_grpc.WeatherServiceStub(channel)
        response = stub.GetWeatherInfo(WeatherRequest(location="Diepenbeek"))

        print("Weather temperatur: %s and Weather condition: %s" % (response.temperature, response.conditions))
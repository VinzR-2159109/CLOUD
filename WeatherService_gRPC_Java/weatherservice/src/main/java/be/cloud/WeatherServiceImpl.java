package be.cloud;

import be.cloud.src.weather;
import io.grpc.stub.StreamObserver;

public class WeatherServiceImpl extends WeatherServiceGrpc.WeatherServiceImplBase {
  
  @Override
  public void getWeatherInfo(WeatherRequest request, StreamObserver<WeatherResponse> responseObserver) {
    weather weather = new weather();

    WeatherResponse response = WeatherResponse.newBuilder()
        .setTemperature(String.valueOf(weather.getTemperature()) + "°C")
        .setConditions(weather.getConditions())
        .build();

    responseObserver.onNext(response);
    responseObserver.onCompleted();
  }
}

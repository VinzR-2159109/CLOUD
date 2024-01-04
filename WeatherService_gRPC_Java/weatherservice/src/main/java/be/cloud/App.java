package be.cloud;
import java.io.IOException;

import io.grpc.Server;
import io.grpc.ServerBuilder;
/**
 * Hello world!
 *
 */
public class App 
{
    public static void main( String[] args )
    {
        Server server = ServerBuilder.forPort(50051)
        .addService(new WeatherServiceImpl())
        .build();

        try {
            server.start();
            System.out.println("Server started, listening on " + server.getPort());
        } catch (IOException e) {
            e.printStackTrace();
        }
        try {
            server.awaitTermination();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
    }
}

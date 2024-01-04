package be.cloud.src;

import java.util.Random;

public class weather {
    private int temperature;
    private String conditions;

    public weather() {
        Random random = new Random();
        temperature = random.nextInt(81) - 30;

        if (temperature < 0) {
            conditions = "Snowy";
        } else if (temperature <= 20) {
            conditions = "Rainy";
        } else {
            conditions = "Sunny";
        }
    }

    public int getTemperature() {
        return temperature;
    }

    public String getConditions() {
        return conditions;
    }
}

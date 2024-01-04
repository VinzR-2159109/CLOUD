import paho.mqtt.client as mqtt
import time
import random

client = mqtt.Client(client_id="publishSensors",
                     transport='tcp',
                     protocol=mqtt.MQTTv5)

client.tls_set(tls_version=mqtt.ssl.PROTOCOL_TLS)
client.username_pw_set("VinzRoosen", "cnVlz@QoG2vTTvyO")

broker = "c38b2e0d43aa445da282c1637c3c0410.s1.eu.hivemq.cloud"
port_tcp = 8883

client.connect(broker, port=port_tcp, clean_start=mqtt.MQTT_CLEAN_START_FIRST_ONLY, keepalive=60)

connected = False
def on_connect(client, userdata, flags, rc, properties=None):
    global connected
    if rc == 0:
        print("Connected to MQTT Broker!")
        connected = True
    else:
        print("Failed to connect, return code %d\n", rc)
client.on_connect = on_connect

client.loop_start()

while True:
    time.sleep(2)

    # hartslag
    heartbeat = random.randint(150, 185)
    if connected:
        client.publish("sensors/heartbeat", str(heartbeat), qos=0)

    # stappentellerg
    steps = 1
    if connected:
        client.publish("sensors/steps", str(steps), qos=0)

    # GPS
    latitude = round(random.uniform(-90, 90),2)
    longitude = round(random.uniform(-180, 180),2)
    if connected:
        client.publish("sensors/gps", f"{latitude},{longitude}", qos=0)

    # accelerometer
    acceleration_x = round(random.uniform(0, 1),3)
    acceleration_y = round(random.uniform(0, 1),3)
    acceleration_z = round(random.uniform(0, 1),3)
    if connected:
        client.publish("sensors/accelerometer", f"{acceleration_x},{acceleration_y},{acceleration_z}", qos=0)

    # barometer
    pressure = round(random.uniform(980, 1030),1)
    if connected:
        client.publish("sensors/barometer", str(pressure), qos=0)

    # temperatuur
    temperature = round(random.uniform(20, 30),1)
    if connected:
        client.publish("sensors/temperature", str(temperature), qos=0)

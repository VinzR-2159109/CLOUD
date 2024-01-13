@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/safetyAlert.css') }}">
    
    <title>WebSocket Client</title>
</head>
<body>
    <div>
        <h1>WebSocket Client</h1>

        <h2>Safety Alert:</h1>
        <label class="switch">
            <input type="checkbox" id="safetySwitch" onchange="toggleSafetyAlert()">
            <span class="slider"></span>
        </label>

        <h2>Send SOS signal:</h1>
        <button id="sosButton" onclick="sendSOS()">Send SOS signal</button>
    </div>
    <script>
        const socket = new WebSocket("ws://localhost:3000");

        let safetyAlertActivated = false;
        let intervalId;
        let lastKnownLocation = { latitude: 0, longitude: 0 };

        const MessageType = {
            ACTIVATE_SAFETY_ALERT: 'activateSafetyAlert',
            SAFETY_ALERT: 'safetyAlert',
            DEACTIVATE_SAFETY_ALERT: 'deactivateSafetyAlert',
            LOCATION_UPDATE: 'locationUpdate',
            SOS: 'SOS'
        };

        socket.addEventListener("message", evt => {
            alert(evt.data);
        });

        async function toggleSafetyAlert() {
            const safetySwitch = document.getElementById("safetySwitch");

            if (safetySwitch.checked) {
                await startSafetyAlert();
            } else {
                stopSafetyAlert();
            }
        }

        async function startSafetyAlert() {
            if (socket.readyState === WebSocket.OPEN && !safetyAlertActivated) {
                const activateSafetyAlert = {
                    type: MessageType.ACTIVATE_SAFETY_ALERT
                };

                socket.send(JSON.stringify(activateSafetyAlert));
                safetyAlertActivated = true;

                intervalId = setInterval(async () => {
                    if (socket.readyState === WebSocket.OPEN) {
                        const message = {
                            type: MessageType.SAFETY_ALERT
                        };
                        socket.send(JSON.stringify(message));
                    }

                    await sendLocationUpdate();
                }, 300);
            }
        }

        function stopSafetyAlert() {
            if (intervalId) {
                clearInterval(intervalId);
                intervalId = null;
                safetyAlertActivated = false;
            }
            if (socket.readyState === WebSocket.OPEN) {
                const message = {
                    type: MessageType.DEACTIVATE_SAFETY_ALERT
                };

                socket.send(JSON.stringify(message));
            }
        }

        async function sendLocationUpdate() {
            try {
                const position = await getCurrentPosition();
                const locationData = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };

                const message = {
                    type: MessageType.LOCATION_UPDATE,
                    location: locationData
                };

                socket.send(JSON.stringify(message));
                lastKnownLocation = locationData;
            } catch (error) {
                console.error('Error getting location:', error);
            }
        }

        async function sendSOS() {
            try {
                const sosMessage = {
                    type: MessageType.SOS,
                    location: lastKnownLocation
                };

                if (socket.readyState === WebSocket.OPEN) {
                    socket.send(JSON.stringify(sosMessage));
                }
            } catch (error) {
                console.error('Error sending SOS:', error);
            }
        }

        async function getCurrentPosition() {
            return new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            });
        }
    </script>
</body>
</html>
@include('footer')
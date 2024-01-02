<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running History</title>
    <link rel="stylesheet" href="{{ asset('css/runningHistoryForm.css') }}">
</head>
<body>
    <h2>Activity was successfully added for userID: {{ $userID}}</h2>
    <button><a href="{{ url('/running-history') }}">Back to Running History</a></button>
</body>
</html>

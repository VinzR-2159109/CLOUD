@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    <title>Running Schedule Maker</title>
</head>
<body>
    <div>
    <h1>Running Schedule Maker</h1>

    <label for="fitnessLevel">Fitness Level:</label>
    <input type="number" id="fitnessLevel" min="1" max="4" value="1">

    <button id="makeScheduleBtn">Maak Running Schedule</button>
    </div>
    <div id="resultContainer"></div>

    <script src="js/runningSchedule.js"></script>
</body>
</html>
@include('footer')
<!-- resources/views/start.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running Services</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Welcome to my Running Services</h1>

        <div class="grid">

        <div class="tile nutrition" onclick="window.location.href='/search-nutrition-form';">
            <h2>Nutrition</h2>
            <p>Manage your nutrition entries</p>
            <p>(REST)</p>
        </div>

        <div class="tile training" onclick="window.location.href='/make-running-schedule-view';">
            <h2>Training</h2>
            <p>Generate and view running schedules</p>
            <p>(Fetch)</p>
        </div>

        <div class="tile graphql" onclick="window.location.href='/social-running-tracker';">
            <h2>Social Running Tracker</h2>
            <p>Track and connect with fellow runners</p>
            <p>(GraphQL)</p>
        </div>
            
    </div>
</body>
</html>

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
        </div>

        <div class="tile training" onclick="window.location.href='/select-fitness-level';">
            <h2>Training</h2>
            <p>Generate and view running schedules</p>
        </div>
            
    </div>
</body>
</html>

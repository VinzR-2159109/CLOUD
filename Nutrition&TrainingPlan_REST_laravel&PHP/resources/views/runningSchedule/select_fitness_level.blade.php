<!-- resources/views/select_fitness_level.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Fitness Level</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <h1>Select Fitness Level</h1>

    <form action="/running-schedule" method="get">
        <label for="fitnessLevel">Choose Fitness Level:</label>
        <select name="fitness_level" id="fitnessLevel">
            <option value="1">Level 1</option>
            <option value="2">Level 2</option>
            <option value="3">Level 3</option>
            <option value="4">Level 4</option>
        </select>

        <button type="submit">Show Running Schedule</button>
    </form>
</body>
</html>

@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running History</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

</head>
<body>

    <h1>Running History</h1>

    <form action="{{ url('/get-running-history') }}" method="post">
    @csrf
        <label for="getHistoryUserId">User ID:</label>
        <input type="text" id="getHistoryUserId" name="userId" required>
        <button type="submit">Get Running Data</button>
    </form>

    <form action="{{ url('/add-running-activity') }}" method="post">
    @csrf
        <label for="addActivityUserId">User ID:</label>
        <input type="text" id="addActivityUserId" name="userId" required>
        <label for="addActivityDistance">Distance (in Km):</label>
        <input type="text" id="addActivityDistance" name="distance" required>
        <label for="addActivityTime">Time (in Minutes):</label>
        <input type="text" id="addActivityTime" name="time" required>
        <button type="submit">Add Running Activity</button>
    </form>
</body>
</html>
@include('footer')
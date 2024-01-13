@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running History</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<style>
    div {
        margin: 0 auto;
        width: 100%;
        max-width: 400px;
        text-align: center; 
    }
</style>
</head>
<body>
    <div>
        <h2>Activity was successfully added for userID: {{ $userID}}</h2>
        <button><a href="{{ url('/running-history') }}" style="text-decoration: none";>Back to Running History</a></button>
    </div>
</body>
</html>
@include('footer')
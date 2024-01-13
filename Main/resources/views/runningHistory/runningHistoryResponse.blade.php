@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running History</title>
    <link rel="stylesheet" href="{{ asset('css/runningHistoryResponse.css') }}">
</head>
<body>
    <h2>Running History</h2>
    <table>
        <thead>
            <th>Category</th>
                @foreach($distances as $distance)
                    <th>Activity {{ $loop->index + 1 }}</th>
                @endforeach
        </thead>

        <tbody>
            <tr>
                <td>Distances</td>
                @foreach($distances as $distance)
                    <td>{{ $distance }} km</td>
                @endforeach
            </tr>
            <tr>
            <td>Durations</td>
                @foreach($durations as $duration)
                    <td>{{ $duration }} min</td>
                @endforeach
            </tr>
            <tr>
            <td>Paces</td>
                @foreach($paces as $pace)
                    <td>{{ $pace }} min/km</td>
                @endforeach
            </tr>
            <tr>
            <td>Calories Burned</td>
                @foreach($calories as $calorie)
                    <td>{{ $calorie }} kcal</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <br>

    <p>Average Pace: {{ $averagePace}} minutes per kilometer</p>
    <p>Total Distance: {{ $totalDistance }} kilometer</p>
    <p>Total Duration: {{ $totalDuration }} minutes</p>
    <p>Total Calories: {{ $totalCalories }} kcal</p>

</body>
</html>
@include('footer')
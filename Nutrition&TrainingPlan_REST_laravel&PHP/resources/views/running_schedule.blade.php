<!-- resources/views/running_schedule.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running Schedule</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Running Schedule</h1>

        <p>Fitness Level: {{ $fitnessLevel }}</p>

        <ul>
            @foreach ($schedule as $day => $info)
                <li>
                    <strong>{{ $day }}:</strong>
                    @if ($info['activity'] === 'rest')
                        Rest day
                    @else
                        Fartlek day with distances: {{ implode(', ', $info['distances']) }}
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>

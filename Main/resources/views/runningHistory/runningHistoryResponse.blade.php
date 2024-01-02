<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Running History Response</title>
    <link rel="stylesheet" href="{{ asset('css/runningHistoryResponse.css') }}">
</head>
<body>
    <h2>Running History Response</h2>

    @if(isset($distances) || isset($durations) || isset($paces) || isset($calories) || isset($averagePace) || isset($successMessage))
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($distances))
                    <tr>
                        <td>Distances</td>
                        <td>
                            @foreach($distances as $distance)
                                <p>{{ is_array($distance) ? implode(', ', array_map('htmlspecialchars', $distance)) : htmlspecialchars($distance) }}</p>
                            @endforeach
                        </td>
                    </tr>
                @endif

                @if(isset($durations))
                    <tr>
                        <td>Durations</td>
                        <td>
                            @foreach($durations as $duration)
                                <p>{{ is_array($duration) ? implode(', ', array_map('htmlspecialchars', $duration)) : htmlspecialchars($duration) }}</p>
                            @endforeach
                        </td>
                    </tr>
                @endif

                @if(isset($paces))
                    <tr>
                        <td>Paces</td>
                        <td>
                            @foreach($paces as $pace)
                                <p>{{ is_array($pace) ? implode(', ', array_map('htmlspecialchars', $pace)) : htmlspecialchars($pace) }}</p>
                            @endforeach
                        </td>
                    </tr>
                @endif

                @if(isset($calories))
                    <tr>
                        <td>Calories Burned</td>
                        <td>
                            @foreach($calories as $calorie)
                                <p>{{ is_array($calorie) ? implode(', ', array_map('htmlspecialchars', $calorie)) : htmlspecialchars($calorie) }}</p>
                            @endforeach
                        </td>
                    </tr>
                @endif

                @if(isset($averagePace))
                    <tr>
                        <td>Calculate Average Pace</td>
                        <td>
                            <p><strong>Average Pace:</strong> {{ htmlspecialchars($averagePace) }}</p>
                        </td>
                    </tr>
                @endif

                @if(isset($successMessage))
                    <tr>
                        <td>Add Running Activity</td>
                        <td>
                            <p class="success">{{ htmlspecialchars($successMessage) }}</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    @endif
</body>
</html>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/nutrition.css') }}">
    <title>Resultaten</title>
</head>
<body>

@if ($entry)
    <h1>{{ $entry->food_name }}</h1>
    <p>Calories: {{ $entry->calories }}</p>
    <p>Protein: {{ $entry->protein }}</p>
    <p>Carbohydrates: {{ $entry->carbohydrates }}</p>
    <p>Fat: {{ $entry->fat }}</p>
@else
    <p>Geen resultaten gevonden voor '{{ request('food_name') }}'.</p>
@endif

</body>
</html>

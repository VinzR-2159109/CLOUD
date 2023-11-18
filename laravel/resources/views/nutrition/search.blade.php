@if ($entry)
    <h1>{{ $entry->food_name }}</h1>
    <p>Calories: {{ $entry->calories }}</p>
    <p>Protein: {{ $entry->protein }}</p>
    <p>Carbohydrates: {{ $entry->carbohydrates }}</p>
    <p>Fat: {{ $entry->fat }}</p>
@else
    <p>Geen resultaten gevonden voor '{{ request('food_name') }}'.</p>
@endif

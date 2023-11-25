<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="stylesheet" href="{{ asset('css/nutritionForm.css') }}">
</head>
<body>
    <form action="{{ url('/search-nutrition') }}" method="post">
        @csrf
        <label for="food_name">Voer Food Name in:</label>
        <input type="text" name="food_name" id="food_name" required>
        <input type="hidden" name="from_form" value="1">
        <button type="submit">Zoeken</button>
    </form>
</body>
</html>

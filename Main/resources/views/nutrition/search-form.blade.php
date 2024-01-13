@include('header')
<!DOCTYPE html>
<html lang="en">
<head> 
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>
<body>
    <form action="{{ url('/search-nutrition') }}" method="post">
        @csrf
        <label for="food_name">Voer Food Name in:</label>
        <input type="text" name="food_name" id="food_name" required>
        <button type="submit">Zoeken</button>
    </form>
</body>
</html>
@include('footer')
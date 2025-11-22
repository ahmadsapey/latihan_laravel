<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50">

    {{-- NAVBAR --}}
    @include('landing.partials.navbar')

    {{-- HERO SECTION --}}
    @include('landing.partials.hero', ['user' => $user])

</body>
</html>

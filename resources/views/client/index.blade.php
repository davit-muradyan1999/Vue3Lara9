<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dvin Gold</title>
    @vite(['resources/js/app.js'])
    @routes
</head>
<body>
    @inertia
</body>
</html>

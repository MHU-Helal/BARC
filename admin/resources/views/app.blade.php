<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vue SPA</title>
    <!-- For CSRF token if using with forms or Sanctum -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Laravel Vite -->
    @vite('resources/js/app.js')
</head>

<body>
    <div id="app"></div>
</body>

</html>
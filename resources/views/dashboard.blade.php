<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sabong App</title>

    <!-- Scripts -->
    <script type="text/javascript" src="{{ mix('/js/app.js') }}" defer></script>
    <!--- Fonts --->
    <link rel="preload" href="./fonts/DMSans-Regular.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="./fonts/DMSans-italic.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="./fonts/DMSans-Medium.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="./fonts/DMSans-MediumItalic.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="./fonts/DMSans-Bold.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <link rel="preload" href="./fonts/DMSans-BoldItalic.ttf" as="font" type="font/ttf" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>

<body class="w-full">
    <div id="dashboard">
    </div>
</body>

</html>

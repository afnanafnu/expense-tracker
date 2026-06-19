<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin · {{ $title ?? config('app.name') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite('resources/css/admin/default/app.css')
    @vite('resources/js/admin/default/app.js')

    @stack('styles')
</head>

<body class="admin-body">


    {{ $slot }}

    @stack('scripts')

</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? config('app.name') }}</title>

    @vite('resources/css/web/default/app.css')
    @vite('resources/js/web/default/app.js')
    @vite('resources/css/web/partials/header.css')
    @vite('resources/css/web/partials/footer.css')

    @stack('styles')
</head>
<body>

    @include('web.layouts.partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('web.layouts.partials.footer')

    @stack('scripts')

</body>
</html>
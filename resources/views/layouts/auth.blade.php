<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="content-Type" content="text/html; utf-8" />
    <meta http-equiv="Pragma" content="cache" />
    <meta name="robots" content="@yield('robots', 'NOINDEX,NOFOLLOW')" />
    <meta http-equiv="content-Language" content="de" />
    <meta name="description" content="@yield('description', 'Marken offener Tuningclub Keine Markenbindung alle Fahrzeugtypen sind willkommen bei uns. Auch du musst nicht der Jugendliche sein Tuning macht auch im Alter Spaß.')" />
    <meta name="author" content="Alexander Guthmann" />
    <meta name="publisher" content="Thüringer Tuning Freunde" />
    <meta name="copyright" content="Alexander Guthmann" />
    <meta http-equiv="Reply-to" content="4l3x83we.dev@gmail.com" />
    <meta name="expires" content="" />
    <meta name="revisit-after" content="2 days" />
    <link rel="alternate" hreflang="x-default" href="{{ url()->full() }}">
    <link rel="alternate" hreflang="de-DE" href="{{ url()->full() }}">
    <link rel="canonical" href="{{ url()->full() }}">
    @include('layouts/partials/meta/meta')
    <meta name="referrer" content="origin" />
    @include('layouts/partials/meta/favicon')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script src="https://www.google.com/recaptcha/api.js"></script>
</head>
<body>
<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                @yield('content')
            </div>
        </section>
    </div>
</main>
</body>
</html>

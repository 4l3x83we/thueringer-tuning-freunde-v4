<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <script id="Cookiebot" src="https://consent.cookiebot.com/uc.js" data-cbid="41affcba-8993-4be4-97d5-fba87adff0fb" data-blockingmode="auto" type="text/javascript"></script>
    @laravelPWA
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="content-Type" content="text/html; utf-8" />
    <meta http-equiv="Pragma" content="cache" />
    <meta name="robots" content="@yield('robots', 'INDEX,NOFOLLOW')" />
    <meta http-equiv="content-Language" content="de" />
    <meta name="description" content="Marken offener Tuningclub Keine Markenbindung alle Fahrzeugtypen sind willkommen bei uns. Auch du musst nicht der Jugendliche sein Tuning macht auch im Alter Spaß." />
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
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Thueringer Tuning Freunde') }}</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    @stack('css')
</head>
<body>
    @guest
    @else
        @foreach($geb as $team)
            @if(\Carbon\Carbon::parse($team->geburtsdatum)->format('d.m') == date('d.m'))
                <div id="alertGeb" class="alert alert-success rounded-0 text-center m-0 p-1 fw-bold" style="font-size: 14px;" role="alert">Alles Gute {{ $team->title }} zum {{ \Carbon\Carbon::parse($team->geburtsdatum)->age . '. Geburtstag' }}</div>
            @endif
        @endforeach
    @endguest

    @include('layouts.partials.nav')

    @include('helpers.component.errors')

    @yield('hero')

    <main class="main" id="main">
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    @hasanyrole('mitglied|super_admin|admin')
        <!-- ======= Fahrzeug Create ======= -->
        @include('frontend.component.fahrzeuge.create')
        <!-- ======= Galerie Create ======= -->
        @include('frontend.component.galerie.create')
        <!-- ======= Event Create ======= -->
        @include('frontend.component.events.create')
        <!-- ======= Tinymce ======= -->
        @include('helpers.component.tinymce')
        <!-- ======= Fileinput ======= -->
        @include('helpers.component.file-input')
    @endhasanyrole
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><em class="bi bi-arrow-up-short"></em></a>
{{--    <div id="preloader"></div>--}}
{{--    @include('component.helpers.pageLoader')--}}
    @stack('js')
</body>
</html>

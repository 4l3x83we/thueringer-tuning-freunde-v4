<!-- ======= Top Bar ======= -->
@include('layouts.partials.topbar')

<!-- ======= Header ======= -->
<header id="header">
    <nav class="navbar navbar-expand-xxl navbar-dark bg-dark shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('frontend.index') }}">
                <div class="d-flex flex-column">
                    <div>{{ env('TTF_NAME') }}</div>
                    <div class="slogan"><span>Marken offener </span>Tuningclub</div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mb-2 mb-lg-0 mx-auto">
                    <li class="nav-item">
                        <a href="/#ueber-uns" class="nav-link {{ Request::is('ueber-uns') ? 'active' : '' }}">Über uns</a>
                    </li>
                    <li class="nav-item">
{{--                        <a href="{{ route('frontend.team.index') }}" class="nav-link {{ Request::is('team') ? 'active' : '' }}">Team</a>--}}
                    </li>
                    <li class="nav-item">
{{--                        <a href="{{ route('frontend.fahrzeuge.index') }}" class="nav-link {{ Request::is('fahrzeuge') ? 'active' : '' }}">Fahrzeuge</a>--}}
                    </li>
                    <li class="nav-item">
{{--                        <a href="{{ route('frontend.galerie.index') }}" class="nav-link {{ Request::is('galerie') ? 'active' : '' }}">Galerie</a>--}}
                    </li>
                    <li class="nav-item">
                        <a href="/#veranstaltungen" class="nav-link {{ Request::is('veranstaltungen') ? 'active' : '' }}">Veranstaltungen</a>
                    </li>
                    <li class="nav-item">
{{--                        <a href="{{ route('frontend.kontakt.index') }}" class="nav-link {{ Request::is('kontakt') ? 'active' : '' }}">Kontakt</a>--}}
                    </li>
                    <li class="nav-item">
{{--                        <a href="{{ route('frontend.antrag.index') }}" class="nav-link {{ Request::is('antrag') ? 'active' : '' }}">Antrag</a>--}}
                    </li>
                    <li class="nav-item">
{{--                        <a href="{{ route('frontend.gaestebuch.index') }}" class="nav-link {{ Request::is('gaestebuch') ? 'active' : '' }}">Gästebuch</a>--}}
                    </li>
                    @hasanyrole('super_admin|admin|mitglied')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Mitglieder Bereich
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-end">
{{--                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#fahrzeugeCreateModal"><em class="bi bi-car-front"></em> Neues Fahrzeug anlegen</a></li>--}}
{{--                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createAlbumModal"><em class="bi bi-file-image"></em> Neues Album anlegen</a></li>--}}
{{--                            <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createVeranstaltungModal"><em class="bi bi-calendar-plus"></em> Neue Veranstaltung anlegen</a></li>--}}
                            <h6 class="dropdown-header">Interner Bereich</h6>
{{--                            <li><a class="dropdown-item" href="{{ route('intern.geburtstagsliste.index') }}"><em class="fa-solid fa-cake-candles"></em> Geburtstagsliste</a></li>--}}
{{--                            <li><a class="dropdown-item" href="{{ route('intern.telefonliste.index') }}"><em class="bi bi-telephone"></em> Telefonliste</a></li>--}}
{{--                            <li><a class="dropdown-item" href="{{ route('intern.kalender.index') }}"><em class="bi bi-calendar-event"></em> Kalender</a></li>--}}
{{--                            <li><a class="dropdown-item" href="{{ route('intern.satzung.index') }}"><em class="fa-solid fa-scale-unbalanced"></em> Satzung</a></li>--}}
                            {{--                            <li><a class="dropdown-item" href="#"><em class="bi bi-shop"></em> Bestellung Textilien</a></li>--}}
                            <hr>
{{--                            <li><a class="dropdown-item" href="{{ route('intern.dashboard.index') }}"><em class="bi bi-gear"></em> Einstellungen</a></li>--}}
                        </ul>
                    </li>
                    @endhasanyrole
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link scrollto" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->vorname .' '. Auth::user()->nachname }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-dark dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @hasanyrole('super_admin|admin')
                                <h6 class="dropdown-header">Interner Bereich</h6>
{{--                                <a href="{{ route('intern.antrag.index') }}" class="dropdown-item">Anträge</a>--}}
                                <a href="{{ route('intern.admin.users.index') }}" class="dropdown-item">Mitglieder</a>
                                <a href="{{ route('intern.admin.roles.index') }}" class="dropdown-item">Rollen</a>
                                <hr>
                                @endhasanyrole
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }} </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>

        </div>
    </nav>
</header>

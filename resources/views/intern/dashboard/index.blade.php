@extends('layouts.app')

@section('title', 'Mitglieder Dashboard')
@section('description'){{ strip_tags(Str::limit('Hier kannst du deine gesamten Einträge auf unsere Seite sehen.'), 150) }}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="dashboard" id="dashboard">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="text-bg-dark shadow border-radius-10 d-block d-sm-flex">
                <div class="profile-tab-nav border-end">
                    <div class="p-4">
                        @if($team->photo_id)
                        <div class="img-circle text-center mb-3">
                            <img src="{{ asset('images/default.png') }}" data-src="{{ asset($previewTeam[$team->id]) }}" alt="Profilbild" class="shadow-sm lozad">
                        </div>
                        @endif
                        <h4 class="text-center">{{ $team->vorname . ' ' . $team->nachname }}</h4>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a href="#profil" class="nav-link active" id="pd-tab" data-bs-toggle="pill" role="tab" aria-controls="pd" aria-selected="true">
                            <em class="bi bi-house"></em> Profil Details
                        </a>
                        <a href="#password" class="nav-link" id="pw-tab" data-bs-toggle="pill" role="tab" aria-controls="pw" aria-selected="true">
                            <em class="bi bi-key"></em> Passwort ändern
                        </a>
                        @if(count($team->alben) > 0)
                        <a href="#galerie" class="nav-link" id="galerie-tab" data-bs-toggle="pill" role="tab" aria-controls="galerie" aria-selected="true">
                            <em class="bi bi-images"></em> Galerie
                        </a>
                        @endif
                        @if(count($team->fahrzeuge) > 0)
                        <a href="#fahrzeuge" class="nav-link" id="fahrzeuge-tab" data-bs-toggle="pill" role="tab" aria-controls="fahrzeuge" aria-selected="true">
                            <em class="bi bi-car-front"></em> Fahrzeuge
                        </a>
                        @endif
                        <a href="#kalender" class="nav-link" id="kalender-tab" data-bs-toggle="pill" role="tab" aria-controls="kalender" aria-selected="true">
                            <em class="bi bi-calendar-event"></em> Kalender
                        </a>
                    </div>
                </div>
                <div class="tab-content" id="v-pills-tabContent">
                    <!-- ======= ProfilDetails ======= -->
                    @include('intern.dashboard.tabs.teamDetails')

                    <!-- ======= Password ======= -->
                    @include('intern.dashboard.tabs.password')

                    <!-- ======= Galerie ======= -->
                    @include('intern.dashboard.tabs.galerie')

                    <!-- ======= Fahrzeuge ======= -->
                    @include('intern.dashboard.tabs.fahrzeuge')

                    <!-- ======= Kalender ======= -->
                    @include('intern.dashboard.tabs.kalender')
                </div>
            </div>

        </div>
    </section>

    @include('helpers.component.datatable')
@endsection

@push('js')
    <script type="module">
        $("#galerieTable #galerie").css("cursor", "pointer");
        $("#galerieTable #galerie").click(function () {
            let link = $(this).attr("href");
            open(link, '_self');
        });
        $("#photoTable #photo").css("cursor", "pointer");
        $("#photoTable #photo").click(function () {
            let link = $(this).attr("href");
            open(link, '_self');
        });
        $("#fahrzeugeTable #fahrzeuge").css("cursor", "pointer");
        $("#fahrzeugeTable #fahrzeuge").click(function () {
            let link = $(this).attr("href");
            open(link, '_self');
        });
    </script>
@endpush

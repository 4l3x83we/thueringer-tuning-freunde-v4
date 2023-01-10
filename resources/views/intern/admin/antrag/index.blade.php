@extends('layouts.app')

@section('title', 'Mitgliedsantragsübersicht')
@section('description'){{ strip_tags(Str::limit('Hier kannst du die eingegangenen Anträge ansehen und freigeben.'), 150) }}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="internAntrag" id="internAntrag">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="row">
                <div class="col-12 text-bg-dark shadow internTable">
                    <div class="table-responsive">
                        <table id="dataTable" class="table responsive table-bordered table-hover w-100">
                            <thead>
                            <tr>
                                <th style="min-width: 25px;">ID</th>
                                <th style="min-width: 100px;">IP Adresse</th>
                                <th>Antragsteller</th>
                                <th style="min-width: 500px;">Gespeicherte Daten</th>
                                <th style="min-width: 15%;">Erstellt am</th>
                                <th>Aktion</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($antrags) > 0)
                                @foreach($antrags as $antrag)
                                    <tr>
                                        <td id="antrag" href="{{ route('intern.admin.antrag.show', $antrag->id) }}">{{ $antrag->id }}</td>
                                        <td id="antrag" href="{{ route('intern.admin.antrag.show', $antrag->id) }}">{{ $antrag->ip_adresse }}</td>
                                        <td id="antrag" href="{{ route('intern.admin.antrag.show', $antrag->id) }}">{{ $antrag->anrede .' '. $antrag->vorname . ' ' . $antrag->nachname }}</td>
                                        <td id="antrag" href="{{ route('intern.admin.antrag.show', $antrag->id) }}">
                                            Anrede, Vorname, Nachname, Straße, PLZ, Ort, Telefon, Mobil, eMail, Geburtsdatum, Beruf, Facebook, Twitter, Instagram, Beschreibung, Profilbild
                                            @if(!$antrag->fahrzeug_vorhanden)
                                                <br><strong>Fahrzeugdaten:</strong> Fahrzeug, Baujahr, Besonderheiten, Motor, Karosserie, Felgen, Fahrwerk, Bremsen, Innenraum, Anlage, Beschreibung, Fahrzeugbilder
                                            @endif
                                        </td>
                                        <td class="align-middle" id="antrag" href="{{ route('intern.admin.antrag.show', $antrag->id) }}">{{ \Carbon\Carbon::parse($antrag->created_at)->isoFormat('ddd DD MMMM YYYY HH:mm:ss') }}</td>
                                        <td class="text-center align-middle">
                                            @if(!$antrag->published)
                                                <em class="bi bi-x-circle text-danger fw-bold"></em>
                                            @else
                                                <em class="bi bi-check-circle text-success fw-bold"></em>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('helpers.component.datatable')
@endsection

@push('js')
    <script type="module">
        let $dataTable_Antrag = $("#dataTable #antrag")
        $dataTable_Antrag.css("cursor", "pointer");
        $dataTable_Antrag.click(function () {
            let link = $(this).attr("href");
            open(link, '_self');
        });
    </script>
@endpush

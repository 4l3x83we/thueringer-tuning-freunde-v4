@extends('emails.layouts.main')

@section('title') Neuer Mitgliedsantrag von {{ $team->vorname . ' ' . $team->nachname }}
@if ($team->fahrzeug_vorhanden == false)
    @if($team->fahrzeuge->fahrzeug) mit dem Fahrzeug {{ $team->fahrzeuge->fahrzeug }}@endif
@endif @endsection

@section('content')
    <p>Ein neuer Mitgliedsantrag ist eingeangen:</p>
    <p>Zum Antrag: <a href="{{ url('admin/antrag', $team->id) }}">hier klicken</a></p>
    <div style="width: 100%; background-color: #292929; color: white; text-align: center;">Persönliche Daten</div>
    <table width="100%" border="0">
        <tr>
            <td style="width: 200px;">Name:</td>
            <td>{{ $team->anrede.' '.$team->vorname.' '.$team->nachname }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Anschrift:</td>
            <td>{{ $team->straße }}<br>{{ $team->plz.' '.$team->wohnort }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Kontaktmöglichkeit:</td>
            <td>{{ $team->telefon.' / '.$team->mobil }}<br>{{ $team->email }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Geburtsdatum:</td>
            <td>
                {{ $team->geburtsdatum }}
                {{ 'Dein Alter: '.$team->gebdatum }}
            </td>
        </tr>
        @if($team->beruf)
            <tr>
                <td style="width: 200px;">Beruf:</td>
                <td>{{ $team->beruf }}</td>
            </tr>
        @endif
        @if ($team->facebook == true or $team->twitter == true or $team->instagram == true)
            <tr>
                <td style="width: 200px;">Social Media:</td>
                <td>
                    @if($team->facebook)
                        <a href="https://www.facebook.com/{{ $team->facebook }}" target="_blank">Facebook: {{ $team->facebook }}</a><br>
                    @endif
                    @if($team->twitter)
                        <a href="https://twitter.com/{{ $team->twitter }}" target="_blank">Twitter: {{ $team->twitter }}</a><br>
                    @endif
                    @if($team->instagram)
                        <a href="https://www.instagram.com/{{ $team->instagram }}/" target="_blank">Instagram: {{ $team->instagram }}</a>
                    @endif
                </td>
            </tr>
        @endif
        @if($team->profilPhoto)
            <tr>
                <td style="width: 200px;">Profilbild:</td>
                <td><img src="{{ asset($team->profilPhoto) }}" style="width: 150px; height: auto;">
                </td>
            </tr>
        @endif
        <tr>
            <td style="width: 200px;">Beschreibung:</td>
            <td>{!! $team->description !!}</td>
        </tr>
        @if ($team->fahrzeugvorhanden == false)
            <tr>
                <td colspan="2">Dein Fahrzeug</td>
            </tr>
            @if($team->fahrzeuge->fahrzeug)
                <tr>
                    <td style="width: 200px;">Fahrzeug:</td>
                    <td>{{ $team->fahrzeuge->fahrzeug }} Baujahr: {{ \Carbon\Carbon::parse($team->fahrzeuge->baujahr)->isoFormat('MMMM YYYY') }}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->besonderheiten)
                <tr>
                    <td style="width: 200px;">Besonderheiten:</td>
                    <td>{!! $team->fahrzeuge->besonderheiten !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->motor)
                <tr>
                    <td style="width: 200px;">Motor:</td>
                    <td>{!! $team->fahrzeuge->motor !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->karosserie)
                <tr>
                    <td style="width: 200px;">Karosserie:</td>
                    <td>{!! $team->fahrzeuge->karosserie !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->felgen)
                <tr>
                    <td style="width: 200px;">Felgen:</td>
                    <td>{!! $team->fahrzeuge->felgen !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->fahrwerk)
                <tr>
                    <td style="width: 200px;">Fahrwerk:</td>
                    <td>{!! $team->fahrzeuge->fahrwerk !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->bremsen)
                <tr>
                    <td style="width: 200px;">Bremsen:</td>
                    <td>{!! $team->fahrzeuge->bremsen !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->innenraum)
                <tr>
                    <td style="width: 200px;">Innenraum:</td>
                    <td>{!! $team->fahrzeuge->innenraum !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->anlage)
                <tr>
                    <td style="width: 200px;">Anlage:</td>
                    <td>{!! $team->fahrzeuge->anlage !!}</td>
                </tr>
            @endif
            @if($team->fahrzeuge->description)
                <tr>
                    <td style="width: 200px;">Beschreibung:</td>
                    <td>{!! $team->fahrzeuge->description !!}</td>
                </tr>
            @endif
            @if(count($team->photos) > 0)
                <tr>
                    <td class="text-right w-25 bg-gray-light">Fahrzeugbilder:</td>
                    <td>
                        @foreach($team->photos as $photo)
                            <img
                                src="{{ asset($photo->images) }}"
                                class="img-fluid img-thumbnail"
                                style="width: 150px; height: 150px; object-fit: cover; object-position: center center; margin: 5px;">
                        @endforeach
                    </td>
                </tr>
            @else
                <tr>
                    <td class="text-right w-25 bg-gray-light">Fahrzeugbilder:</td>
                    <td class="text-danger font-weight-bold">Es wurden keine Bilder hochgeladen!</td>
                </tr>
            @endif
        @endif
    </table>
    <p>Zum Antrag: <a href="{{ url('admin/antrag', $team->id) }}">hier klicken</a></p>
@endsection

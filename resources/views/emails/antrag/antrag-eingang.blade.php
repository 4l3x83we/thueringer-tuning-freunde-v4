@extends('emails.layouts.main')

@section('title', 'Neuer Mitgliedsantrag')

@section('content')
    <p>Dein Mitgliedsantrag ist eingegangen und wird nun geprüft, du wirst in Kürze von uns hören:</p>
    <p>Wir würden uns freuen dich an einem Samstag in <a href="https://www.google.de/maps/place/Schallenburger+Str.+37,+99610+S%C3%B6mmerda/@51.1431963,11.1057134,368m/data=!3m2!1e3!4b1!4m5!3m4!1s0x47a46abb19a61969:0x1150d22767f5ce38!8m2!3d51.1431946!4d11.1068162" target="_blank">Sömmerda in der Schallenburger Straße 37</a> begrüßen zu dürfen, <u>in der Zeit von 09:30 - 13:00 Uhr</u>, bitte kontaktiere uns vorher.</p>
    <p>E-Mail: {{ env('TTF_EMAIL') }}</p>
{{--    <p>Telefon: {{ env('TTF_TELEFON') }}</p>--}}
    <p>Hier nochmal deine Daten in der Übersicht:</p>
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
                {{--                {{ 'Dein Alter: '.$team->gebdatum }}--}}
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
                    @if($team->tiktok)
                        <a href="https://twitter.com/{{ $team->tiktok }}" target="_blank">TikTok: {{ $team->tiktok }}</a><br>
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
        @if ($team->fahrzeug_vorhanden == false)
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
@endsection

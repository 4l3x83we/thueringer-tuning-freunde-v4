@extends('emails.layouts.main')

@section('title', 'Dein Mitgliedsantrag wurde soeben genehmigt.')

@section('content')
    <p>Hallo {{ $antrag->vorname }},</p>
    <p>soeben wurde dein Mitgliedsantrag genehmigt.</p>
    <p>Du erhältst im Anschluss noch eine E-Mail, in der du aufgefordert wirst, ein Passwort festzulegen, dieses benötigst
        du für den internen Bereich und um auf der Webseite dein Profil zu bearbeiten oder Bilder hinzuzufügen.</p>
    <p>Des Weiteren kannst du auch Galerien anlegen und Veranstaltungen einstellen.</p>
    <p>Oder du kannst einfach ein weiteres Fahrzeug anlegen, oder ein Projektfahrzeug von dir, was du gerade aufbaust.</p>

    <p>Das gesamte Team der Thüringer Tuning Freunde wünscht dir viel Spaß bei uns.</p>

    <p>Zu deinem Eintrag: <a href="{{ url('team', $antrag->slug) }}">hier klicken</a> </p>


    @if ($antrag->fahrzeugvorhanden == false)
        <p>Zu deinem Fahrzeug: <a href="{{ url('fahrzeuge', $antrag->fahrzeuge->slug) }}">hier klicken</a> </p>
    @endif

    <p>Deine Zugangsdaten zum internen Bereich vorab:<br>
        <span>E-Mail-Adresse: {{ $antrag->userEmail }}</span>
        <span>Password: {{ $antrag->passwort }}</span>
    </p>

    <a href="{{ route('login') }}">zum Login</a>
@endsection

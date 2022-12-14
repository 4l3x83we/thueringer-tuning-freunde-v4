@extends('emails.layouts.main')

@section('title') Du wirst vermisst! @endsection

@section('content')
    <h3>Hallo {{ $team->vorname }},</h3>
    <span style="margin-bottom: 10px;">Du hast schon lange nicht mehr unsere Webseite genutzt.</span><br>
    <span style="margin-bottom: 10px;">Wir würden uns freuen, wenn Du den Dich mal wieder blicken lässt.</span><br><br>

    <a style="margin: 20px 0;" href="{{ \Illuminate\Support\Facades\URL::to('login') }}">Zum Login.</a><br><br>

    @if($user->last_seen)
        <span style="margin-bottom: 10px;">Du warst das letzte Mal am {{ \Carbon\Carbon::parse($user->last_seen)->isoFormat('DD.MM.YYYY') }} eingeloggt.</span>
    @else
        <span style="margin-bottom: 10px;">Du warst noch nie eingeloggt.</span><br><br>
        <span style="margin-bottom: 10px;">Du kennst Dein Passwort nicht oder Deine registrierte E-Mail-Adresse?</span><br><br>
        <span>Deine E-Mail-Adresse: {{ $user->email }}</span><br><br>
        <span>Kein Problem, hier kannst Du Dein Passwort </span><a style="margin: 20px 0;" href="{{ \Illuminate\Support\Facades\URL::to('password/reset') }}">zurücksetzten</a><br>
    @endif

@endsection

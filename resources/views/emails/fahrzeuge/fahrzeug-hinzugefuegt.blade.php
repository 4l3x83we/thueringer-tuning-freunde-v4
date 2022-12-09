@extends('emails.layouts.main')

@section('title') Fahrzeug hinzugefügt &#128516. @endsection

@section('content')
    <p style="margin: 0;">Hallo,</p>
    <p>soeben wurde ein Fahrzeug hinzugefügt.</p>

    <p>Hier der Link zur Überprüfung des Fahrzeuges: <a href="{{ url('fahrzeuge/'.$fahrzeuge->slug) }}">{{ url('fahrzeuge/'.$fahrzeuge->slug) }}</a>.</p>
    <p>Danke sagt euer Mitglied {{ auth()->user()->vorname }}.</p>
@endsection

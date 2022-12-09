@extends('emails.layouts.main')

@section('title', 'Eine Veranstaltung wurde bearbeitet und wartet auf Prüfung.')

@section('content')
    <p style="margin: 0;">Hallo Alex und Heiko,</p>
    <p>wir haben soeben unsere Veranstaltung ({{ $veranstaltungen->veranstaltung }}) geändert.</p>

    <p>Bitte prüft die Veranstaltung schnell, sodass sie bald wieder Online ist.</p>

    <p>Zur Veranstaltung hier lang: <a class="btn btn-sm btn-secondary" href="{{ url('veranstaltungen/'.$veranstaltungen->slug) }}">{{ $veranstaltungen->veranstaltung }}</a></p>

    <p>Danke sagt der Veranstalter {{ $veranstaltungen->veranstalter }}.</p>
@endsection

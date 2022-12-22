@extends('emails.layouts.main')

@section('title') @if($assumed->present === 1) Teilnahmebestätigung für die Versammlung am: {{ \Carbon\Carbon::parse($kalender->von)->format('d.m.Y') }}. @else Absage für die Versammlung am: {{ \Carbon\Carbon::parse($kalender->von)->format('d.m.Y') }}. @endif @endsection

@section('content')
    <p>Hallo Heiko & Alex,</p>
    @if($assumed->present === 1)
        <p>{{ $kalender->teams[0]->vorname }} {{ $kalender->teams[0]->nachname[0] }}. nimmt an der Versammlung teil.</p>
    @else
        <p>
            {{ $kalender->teams[0]->vorname }} {{ $kalender->teams[0]->nachname[0] }}. sagt die Versammlung ab.<br>
            <br>
            Grund für die Absage:<br>{{ $assumed->cancellation_reason }}
        </p>
    @endif
@endsection

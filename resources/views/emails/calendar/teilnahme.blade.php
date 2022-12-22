@extends('emails.layouts.main')

@section('title') @if($assumed->present === 1) Teilnahmebestätigung für die Versammlung am: {{ \Carbon\Carbon::parse($kalender->von)->format('d.m.Y') }}. @else Absage für die Versammlung am: {{ \Carbon\Carbon::parse($kalender->von)->format('d.m.Y') }}. @endif @endsection

@section('content')
    <p>Hallo {{ $kalender->teams[0]->title }},<p>

    @if($assumed->present === 1)
        <p>wir freuen uns dich am {{ \Carbon\Carbon::parse($kalender->von)->format('d.m.Y') }} in {{ explode(', ', $kalender->eigenesFZ)[2] }} begrüßen zu dürfen.</p>
        <p>
            <strong>Adresse:</strong><br>
            <span>{{ explode(', ', $kalender->eigenesFZ)[0] }}</span><br>
            <span>{{ explode(', ', $kalender->eigenesFZ)[1] }}</span><br>
            <span>{{ explode(', ', $kalender->eigenesFZ)[2] }}</span><br><br>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg> <a href="https://maps.google.com/maps?saddr=&daddr={{ str_replace(",", "", str_replace(" ", "+", $kalender->adresse)) }}" target="_blank">Hier gehts zur Routenplanung</a>
        </p>
        <p>Deine automatische Benachrichtigung kommt in der Nacht zum {{ \Carbon\Carbon::parse($kalender->von)->subDay($assumed->memory)->format('d.m.Y') }} an diese E-Mail-Adresse.</p>
    @else
        <p>Schade das du nicht kannst.<br>Wir würden uns freuen wenn du beim nächsten Mal dabei bist.</p>
        <p>Absagegrund:<br>{{ $assumed->cancellation_reason }}</p>
    @endif
@endsection

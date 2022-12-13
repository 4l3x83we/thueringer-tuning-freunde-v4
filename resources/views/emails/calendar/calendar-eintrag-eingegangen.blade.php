@extends('emails.layouts.main')

@section('title') @if($kalender['type']->type === 'Versammlung') Neue Versammlung und Übernahme in den Kalender @else Neuer Kalendereintrag @endif @endsection

@section('content')
    @if($kalender['type']->type === 'Versammlung')
        <p>Wir bitten dich, diesen Termin in deinen Terminplaner einzutragen und würden uns freuen, wenn du den Termin wahrnimmst.</p>
        <p>Gib uns bitte bis zum {{ \Carbon\Carbon::parse($kalender->bis)->subWeeks(2)->isoFormat('DD.MM.YYYY') }} Bescheid damit wir planen können.</p>
    <p>zum Kalendereintrag: <a href="{{ url('/intern/kalender').'#'.$kalender->id }}">hier klicken</a></p>
    <table style="width: 100%; border: none;">
        <tr>
            <td style="width: 200px;">Datum:</td>
            <td>{{ \Carbon\Carbon::parse($kalender->von)->isoFormat('DD.MM.YYYY') . ' - ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('DD.MM.YYYY') }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Uhrzeit:</td>
            @if(\Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') != \Carbon\Carbon::parse($kalender->bis)->isoFormat('HH:mm'))
                <td>{{ \Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('HH:mm') . ' Uhr' }}</td>
            @else
                <td>{{ 'ab: ' . \Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') . ' Uhr' }}</td>
            @endif
        </tr>
        <tr>
            <td style="width: 200px;">Beschreibung:</td>
            <td>{!! $kalender->description !!}</td>
        </tr>
    </table>
    @else
        <p>Hallo {{ $kalender->team->vorname }},</p>
    <p>zum Kalendereintrag: <a href="{{ url('/intern/kalender').'#'.$kalender->id }}">hier klicken</a></p>
    <table style="width: 100%; border: none;">
        <tr>
            <td style="width: 200px;">Datum:</td>
            <td>{{ \Carbon\Carbon::parse($kalender->von)->isoFormat('DD.MM.YYYY') . ' - ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('DD.MM.YYYY') }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Uhrzeit:</td>
            @if(\Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') != \Carbon\Carbon::parse($kalender->bis)->isoFormat('HH:mm'))
                <td>{{ \Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('HH:mm') . ' Uhr' }}</td>
            @else
                <td>{{ 'ab: ' . \Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') . ' Uhr' }}</td>
            @endif
        </tr>
        <tr>
            <td style="width: 200px;">Was:</td>
            <td>{{ $kalender['type']->type }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Eigenes Fahrzeug:</td>
            <td>@if($kalender->eigenesFZ) Ja @else Nein @endif</td>
        </tr>
        <tr>
            <td style="width: 200px;">Beschreibung:</td>
            <td>{!! $kalender->description !!}</td>
        </tr>
    </table>
    @endif
@endsection

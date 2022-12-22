@extends('emails.layouts.main')

@section('title') Kalendereintrag wurde geändert. @endsection

@section('content')
    <p>Hallo {{ $kalender->team->title . ' & ' . $kalender->user->title }},<br>
    dein Kalendereintrag wurde geändert.
    </p>
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
@endsection

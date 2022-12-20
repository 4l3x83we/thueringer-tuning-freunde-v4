@extends('emails.layouts.main')

@section('title', 'Termin Übersicht Ansprechpartner')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
    <style>
        .bi-check-circle {
            color: green;
        }
        .bi-x-circle {
            color: red;
        }
        .flex-container {
            display: flex;
            flex-direction: row;
        }
        .flex-item-left {
            padding: 5px 10px;
            flex: 15%;
        }
        .flex-item-right {
            padding: 5px 10px;
            flex: 85%;
        }
        .flex-item {
            padding: 5px 10px;
            flex: 100%;
        }
        .apmh {
            background-color: #ff4400;
            color: black;
        }
        .apoh {
            background-color: #4caf50;
            color: black;
        }
        .sp {
            background-color: #666666;
        }
        .rw {
            background-color: #00bcd4;
            color: black;
        }
        .borderHR {
            border: 0;
            color: inherit;
            border-bottom: 1px solid;
            margin: 15px 0;
        }
        .borderHR:last-child {
            border: 0;
            margin: 0;
        }
        @media (max-width: 800px) {
            .flex-container {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <p>Hallo {{ $kalenders->vorname }},<br>
    hier bekommst du eine Übersicht über deine Termine in der Werkstatt/Halle.</p>
        @foreach($kalenders as $kalender)
            <div class="flex-container">
                <div class="flex-item {{ $kalender->typeColor }}">{{ $kalender->type }}</div>
            </div>
            <div class="flex-container">
                <div class="flex-item-left">Termin mit:</div>
                <div class="flex-item-right">@if($kalender->team_vorname !== $kalender->team_title) {{ $kalender->team_title }} @else {{ $kalender->team_vorname }} @endif<br>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                    </svg>
                    <a href="mailto:{{ $kalender->team_email }}">{{ $kalender->team_email }}</a>
                </div>
            </div>
            <div class="flex-container">
                <div class="flex-item-left">Wann:</div>
                @if(\Carbon\Carbon::parse($kalender->von)->isoFormat('DD.MM.YYYY') === \Carbon\Carbon::parse($kalender->bis)->isoFormat('DD.MM.YYYY'))
                    <div class="flex-item-right">
                        {{ 'am ' . \Carbon\Carbon::parse($kalender->von)->isoFormat('dddd DD.MM.YYYY') . ' von ' . \Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('HH:mm') }}
                    </div>
                @else
                    <div class="flex-item-right">
                        {{ 'am ' . \Carbon\Carbon::parse($kalender->von)->isoFormat('dddd DD.MM.YYYY') . ' - ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('dddd DD.MM.YYYY') }}<br>
                        {{ 'von ' . \Carbon\Carbon::parse($kalender->von)->isoFormat('HH:mm') . ' bis ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('HH:mm') }}<br>
                        {{ \App\Helpers\Helpers::getDaysRate($kalender->von, $kalender->bis) . ' Tag' }}
                    </div>
                @endif
            </div>
            <div class="flex-container">
                <div class="flex-item-left">Was ist zu tun:</div>
                <div class="flex-item-right">{!! nl2br($kalender->description) !!}</div>
            </div>
            <div class="flex-container">
                <div class="flex-item-left">am eigenen Fahrzeug?:</div>
                <div class="flex-item-right">@if($kalender->eigenesFZ)
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                        </svg> Ja
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg> Nein <br>
                        <span style="font-weight: bold; color: red;">Preisliste beachten!</span>
                    @endif
                </div>
            </div>
            <div class="flex-container">
                <div class="flex-item">
                    <a href="{{ route('intern.kalender.index').'/#'.$kalenders->id }}" target="_blank">Hier geht es zum internen Kalender.</a><br>
                    <a href="https://calendar.google.com/calendar/embed?src=277c810422ca9f6f51822f462cd9a3fb801afaeeafceb963bf06a693f4f3b917%40group.calendar.google.com&ctz=Europe%2FBerlin" target="_blank">Hier geht es zum Google Kalender.</a> <br>
                    Denn Google Kalender kannst du auch zu deinem bestehenden Kalender hinzufügen, dafür einfach unten rechts auf das + klicken.
                </div>
            </div>
            <div class="borderHR"></div>
        @endforeach
@endsection

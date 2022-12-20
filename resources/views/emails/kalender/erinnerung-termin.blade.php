@extends('emails.layouts.main')

@section('title', 'Terminerinnerung')

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
        a {
            color: #cccccc !important;
            transition: 0.3s;
        }
        a:hover {
            color: #ff4400 !important;
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
        wir möchten dich nochmal an deinen Termin bei uns erinnern.</p>
    <div class="flex-container">
        <div class="flex-item-left">Termin mit:</div>
        <div class="flex-item-right">@if($kalenders->team_vorname !== $kalenders->team_title) {{ $kalenders->team_title }} @else {{ $kalenders->team_vorname }} @endif<br>
            <a style=" text-decoration: none;" href="mailto:{{ $kalenders->team_email }}?subject=Frage zum {{ $kalenders->type }} Termin am {{ \Carbon\Carbon::parse($kalenders->von)->isoFormat('DD.MM.YYYY HH:mm') . ' Uhr bis ' . \Carbon\Carbon::parse($kalenders->bis)->isoFormat('DD.MM.YYYY HH:mm') }} Uhr.&bcc={{ $kalenders->email }}&body=Hallo {{ $kalenders->team_vorname }},%0D%0A%0D%0A">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                </svg>
            </a>
            <a href="tel:{{ $kalenders->team_mobil }}" style="padding-left: 20px; text-decoration: none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
                    <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h6zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H5z"/>
                    <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                </svg>
            </a>
            <a style="padding-left: 20px; text-decoration: none;" href="https://wa.me/{{ $kalenders->team_mobil }}?text=Hallo {{ $kalenders->team_vorname }},%20%20frage zum {{ $kalenders->type }} Termin am {{ \Carbon\Carbon::parse($kalenders->von)->isoFormat('DD.MM.YYYY HH:mm') . ' Uhr bis ' . \Carbon\Carbon::parse($kalenders->bis)->isoFormat('DD.MM.YYYY HH:mm') }} Uhr.">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                </svg>
            </a>
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">Wann:</div>
        @if(\Carbon\Carbon::parse($kalenders->von)->isoFormat('DD.MM.YYYY') === \Carbon\Carbon::parse($kalenders->bis)->isoFormat('DD.MM.YYYY'))
            <div class="flex-item-right">
                {{ 'am ' . \Carbon\Carbon::parse($kalenders->von)->isoFormat('dddd DD.MM.YYYY') . ' von ' . \Carbon\Carbon::parse($kalenders->von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($kalenders->bis)->isoFormat('HH:mm') }}
            </div>
        @else
            <div class="flex-item-right">
                {{ 'am ' . \Carbon\Carbon::parse($kalenders->von)->isoFormat('dddd DD.MM.YYYY') . ' - ' . \Carbon\Carbon::parse($kalenders->bis)->isoFormat('dddd DD.MM.YYYY') }}<br>
                {{ 'von ' . \Carbon\Carbon::parse($kalenders->von)->isoFormat('HH:mm') . ' bis ' . \Carbon\Carbon::parse($kalenders->bis)->isoFormat('HH:mm') }}<br>
                {{ \App\Helpers\Helpers::getDaysRate($kalenders->von, $kalenders->bis) . ' Tag' }}
            </div>
        @endif
    </div>
    <div class="flex-container">
        <div class="flex-item-left">Was ist zu tun:</div>
        <div class="flex-item-right">{!! nl2br($kalenders->description) !!}</div>
    </div>
    <div class="flex-container">
        <div class="flex-item-left">am eigenen Fahrzeug?:</div>
        <div class="flex-item-right">@if($kalenders->eigenesFZ)
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                </svg> Ja
            @else
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg> Nein <br>
                <span style="font-weight: bold; color: red;">Bitte beachte, dass hier weitere Kosten auf dich zukommen können.</span>
            @endif
        </div>
    </div>
    <div class="flex-container">
        <div class="flex-item">
            <a href="{{ route('intern.kalender.index') }}" target="_blank">Hier geht es zum internen Kalender.</a><br>
            <a href="https://calendar.google.com/calendar/embed?src=277c810422ca9f6f51822f462cd9a3fb801afaeeafceb963bf06a693f4f3b917%40group.calendar.google.com&ctz=Europe%2FBerlin" target="_blank">Hier geht es zum Google Kalender.</a> <br>
            Denn Google Kalender kannst du auch zu deinem bestehenden Kalender hinzufügen, dafür einfach unten rechts auf das + klicken.
        </div>
    </div>
    <div class="borderHR"></div>
@endsection

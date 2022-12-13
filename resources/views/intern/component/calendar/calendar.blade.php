<!-- ======= Calendar entry ======= -->

<!-- ======= Person der Eintragung ======= -->
<div class="event-box-content-items-icons"><em class="bi bi-person"></em></div>
<div class="event-box-content-items-content">{{ $calender->team->vorname . ' ' . $calender->team->nachname }}</div>

<!-- ======= Type ======= -->
<div class="event-box-content-items-icons"><em class="bi bi-wrench"></em></div>
<div class="event-box-content-items-content">{{ $calender->kalendertype->type }}</div>

<!-- ======= Uhrzeit ======= -->
<div class="event-box-content-items-icons"><em class="bi bi-clock"></em></div>
<div class="event-box-content-items-content">
    @if(\Carbon\Carbon::parse($calender->von)->isoFormat('HH:mm') != \Carbon\Carbon::parse($calender->bis)->isoFormat('HH:mm'))
        {{ \Carbon\Carbon::parse($calender->von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($calender->bis)->isoFormat('HH:mm') . ' Uhr' }}
    @else
        {{ 'ab: ' . \Carbon\Carbon::parse($calender->von)->isoFormat('HH:mm') . ' Uhr' }}
    @endif
</div>

<!-- ======= eigenes Kraftfahrzeug ======= -->
<div class="event-box-content-items-icons"><em class="bi bi-car-front"></em></div>
<div class="event-box-content-items-content">{{ 'Eigenes Fahrzeug: ' . $calender->eigenesFZ }}</div>

<!-- ======= Bestätigt ======= -->
@if($calender->assumed)
    <div class="event-box-content-items-icons text-success"><em class="bi bi-calendar-check"></em></div>
    <div class="event-box-content-items-content text-success">{{ 'Termin bestätigt' }}</div>
@else
    <div class="event-box-content-items-icons text-danger"><em class="bi bi-calendar-minus"></em></div>
    <div class="event-box-content-items-content text-danger">{{ 'Termin noch nicht bestätigt' }}</div>
@endif

<!-- ======= Ansprechpartner ======= -->
@if($calender->kalendertype->cp_user_id)
    <div class="event-box-content-items-icons"><em class="bi bi-person-check"></em></div>
    <div class="event-box-content-items-content">{{ 'Ansprechpartner: ' . $calender->cp->vorname . ' ' . $calender->cp->nachname . ' / ' . $calender->cp->mobil }}</div>
@endif

<div class="event-box-content-items-icons"><hr></div>
<div class="event-box-content-items-content"><hr></div>

<!-- ======= Description ======= -->
<div class="event-box-content-items-icons">&nbsp;</div>
<div class="event-box-content-items-content fs-5">
    {!! $calender->description !!}
</div>

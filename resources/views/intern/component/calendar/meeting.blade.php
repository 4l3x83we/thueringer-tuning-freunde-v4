<!-- ======= Versammlung ======= -->

<!-- ======= Uhrzeit ======= -->
<div class="event-box-content-items-icons"><em class="bi bi-clock"></em></div>
<div class="event-box-content-items-content">
    @if(\Carbon\Carbon::parse($calender->von)->isoFormat('HH:mm') != \Carbon\Carbon::parse($calender->bis)->isoFormat('HH:mm'))
        {{ \Carbon\Carbon::parse($calender->von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($calender->bis)->isoFormat('HH:mm') . ' Uhr' }}
    @else
        {{ 'ab: ' . \Carbon\Carbon::parse($calender->von)->isoFormat('HH:mm') . ' Uhr' }}
    @endif
</div>

<!-- ======= Differenz Days ======= -->
@if(App\Helpers\Helpers::getDaysRate(now(), $calender->von) === 0)
    <div class="event-box-content-items-icons"><em class="bi bi-clock-history"></em></div>
    <div class="event-box-content-items-content">
        {{ 'Veranstaltung in: ' . App\Helpers\Helpers::getHourRate(now(), $calender->von) . ' h' }}
    </div>
    @elseif(App\Helpers\Helpers::getDaysRate(now(), $calender->von) === 1)
    <div class="event-box-content-items-icons"><em class="bi bi-clock-history"></em></div>
    <div class="event-box-content-items-content">
        {{ App\Helpers\Helpers::getDaysRate(now(), $calender->von) . ' Tag noch' }}
    </div>
    @else
    <div class="event-box-content-items-icons"><em class="bi bi-clock-history"></em></div>
    <div class="event-box-content-items-content">
        {{ App\Helpers\Helpers::getDaysRate(now(), $calender->von) . ' Tage noch' }}
    </div>
@endif

<!-- ======= Differenz Time ======= -->
<div class="event-box-content-items-icons"><em class="bi bi-stopwatch"></em></div>
<div class="event-box-content-items-content">
{{ 'Geplant für: ' . App\Helpers\Helpers::getHourRate($calender->von, $calender->bis) . ' h' }}
</div>

<!-- ======= Versammlungsort ======= -->
<div class="event-box-content-items-icons"><em class="bi bi-geo-alt"></em></div>
<div class="event-box-content-items-content">{{ $calender->eigenesFZ }}</div>

<!-- ======= Versammlung bestätigt ======= -->
@if($calender->assumed)
    <div class="event-box-content-items-icons text-success"><em class="bi bi-calendar-check"></em></div>
    <div class="event-box-content-items-content text-success">{{ 'Termin bestätigt' }}</div>
@else
    <div class="event-box-content-items-icons text-danger"><em class="bi bi-calendar-minus"></em></div>
    <div class="event-box-content-items-content text-danger d-inline-flex justify-content-between">{{ 'Termin noch nicht bestätigt' }}
        @if($calender->contact_person_user_id === auth()->user()->id)
            <form action="{{ route('intern.kalender.versammlungUpdate', $calender->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="assumed" value="1">
                <button type="submit" class="btn btn-link p-0 m-0 text-success"><em class="bi bi-check-circle"></em></button>
            </form>
        @endif
    </div>
@endif

<!-- ======= Verantwortlicher ======= -->
@if($calender->contact_person_user_id)
    <div class="event-box-content-items-icons"><em class="bi bi-person-check"></em></div>
    <div class="event-box-content-items-content">{{ 'Ansprechpartner: ' . $calender->team->vorname . ' ' . $calender->team->nachname . ' / ' . $calender->team->mobil }}</div>
@endif

<div class="event-box-content-items-icons"><hr></div>
<div class="event-box-content-items-content"><hr></div>

<!-- ======= Beschreibung ======= -->
<div class="event-box-content-items-icons d-none" style="width: 0;">&nbsp;</div>
<div class="event-box-content-items-content fs-5">
    {!! $calender->description !!}
</div>

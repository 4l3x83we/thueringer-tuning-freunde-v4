<!-- ======= Timebox ======= -->
<div class="event-box-time">
    <time datetime="{{ $calender->von }}">
        <div class="day">{{ \Carbon\Carbon::parse($calender->von)->isoFormat('DD') }}</div>
        @if(\Carbon\Carbon::parse($calender->von)->isoFormat('DD.MM.YYYY') != \Carbon\Carbon::parse($calender->bis)->isoFormat('DD.MM.YYYY'))
            <em class="bi bi-dash"></em>
        @endif
        @if(\Carbon\Carbon::parse($calender->von)->isoFormat('DD') != \Carbon\Carbon::parse($calender->bis)->isoFormat('DD'))
            <div class="day">{{ \Carbon\Carbon::parse($calender->bis)->isoFormat('DD') }}</div>
        @endif
        <div class="month">{{ \Carbon\Carbon::parse($calender->bis)->shortMonthName }}</div>
        @if(\Carbon\Carbon::parse($calender->bis)->isoFormat('YYYY') !== now()->isoFormat('YYYY'))
            <div class="year">{{ \Carbon\Carbon::parse($calender->bis)->isoFormat('YYYY') }}</div>
        @endif
    </time>
</div>

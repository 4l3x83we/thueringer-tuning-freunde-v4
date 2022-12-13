<div class="col-lg-12 mt-4" id="{{ $calender->id }}">
    <div class="event-box shadow">
        <div class="event-box-time-social {{ $calender->kalendertype->typeColor }}" data-aos="flip-down" data-aos-delay="300">
            @include('intern.component.calendar.timebox')
            @hasanyrole('super_admin|admin')
            <div class="event-box-social">
                <form action="{{ route('intern.kalender.destroy', $calender->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="type" value="{{ $calender->kalendertype->id }}">
                    <input type="hidden" name="user_id" value="{{ $calender->team->id }}">
                    <button type="submit" class="btn btn-link btn-sm p-0"><em class="bi bi-trash text-black fw-bold pe-0"></em></button>
                </form>
            </div>
            @endhasanyrole
        </div>
        <div class="event-box-content" data-aos="flip-down" data-aos-delay="500">
            <h4 @if($calender->kalendertype->type === 'Versammlung') class="text-danger" @endif>@if($calender->kalendertype->type === 'Versammlung') Versammlung @else {{ 'Reserviert: ' . $calender->kalendertype->type }} @endif</h4>
            <div class="event-box-content-items">
                @if($calender->kalendertype->type === 'Versammlung')
                    @include('intern.component.calendar.meeting')
                @else
                    @include('intern.component.calendar.calendar')
                @endif
            </div>
            @if($calender->published_at)
                <div class="event-box-webseite">
                    @if($calender->updated_at != $calender->published_at)
                        <em class="bi bi-clock-fill"> Geändert am: {{ \Carbon\Carbon::parse($calender->updated_at)->isoFormat('DD.MM.YYYY HH:mm') }}</em>
                    @else
                        <em class="bi bi-clock-fill"> Veröffentlicht am: {{ \Carbon\Carbon::parse($calender->published_at)->isoFormat('DD.MM.YYYY HH:mm') }}</em>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

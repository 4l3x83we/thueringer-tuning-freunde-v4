<section class="veranstaltungen text-bg-dark" id="veranstaltungen">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
            <h2>Veranstaltungen</h2>
        </div>

        <div class="row">

            @if(count($veranstaltungens) > 0)
                @foreach($veranstaltungens as $veranstaltungen)
                    @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('DD.MM.YYYY') != date('d.m.Y') or \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('DD.MM.YYYY') == date('d.m.Y'))
                        <div class="@if(count($veranstaltungens) === 1) col-lg-12 @else col-lg-6 @endif mt-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="event-box shadow">
                                <div class="event-box-time-social" data-aos="flip-down" data-aos-delay="300">
                                    <div class="event-box-time">
                                        <time datetime="{{ $veranstaltungen->datum_von }}">
                                            <span class="day">{{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('DD') }}</span>
                                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('MM') != \Carbon\Carbon::now()->isoFormat('MM'))
                                                <span class="month">{{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->shortMonthName }}</span>
                                            @endif
                                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('YYYY') != \Carbon\Carbon::now()->isoFormat('YYYY'))
                                                <span class="year">{{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('YYYY') }}</span>
                                            @endif
                                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('DD.MM.YYYY') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('DD.MM.YYYY'))
                                                <em class="bi bi-dash"></em>
                                            @endif
                                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('DD') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('DD'))
                                                <span class="day">{{ \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('DD') }}</span>
                                            @endif
                                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('MM') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('MM'))
                                            <span class="month">{{ \Carbon\Carbon::parse($veranstaltungen->datum_bis)->shortMonthName }}</span>
                                            @endif
                                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('YYYY') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('YYYY'))
                                                <span class="year">{{ \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('YYYY') }}</span>
                                            @endif
                                        </time>
                                    </div>
                                </div>
                                <div class="event-box-content" data-aos="flip-down" data-aos-delay="500">
                                    <h4>{{ $veranstaltungen->veranstaltung }}</h4>
                                    <div class="event-box-content-items">
                                        <div class="event-box-content-items-icons"><em class="bi bi-flag"></em></div>
                                        <div class="event-box-content-items-content">{{ $veranstaltungen->veranstalter }}</div>
                                         @if($veranstaltungen->eintritt)
                                            <div class="event-box-content-items-icons"><em class="bi bi-ticket-perforated"></em></div>
                                            <div class="event-box-content-items-content">{{ $veranstaltungen->eintritt }}</div>
                                        @else
                                            <div class="event-box-content-items-icons"><em class="bi bi-ticket-perforated"></em></div>
                                            <div class="event-box-content-items-content">Kein Eintrittspreis bekannt.</div>
                                        @endif
                                        <div class="event-box-content-items-icons"><em class="bi bi-clock"></em></div>
                                        <div class="event-box-content-items-content">
                                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm'))
                                                {{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm') . ' Uhr' }}
                                            @else
                                                {{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' Uhr' }}
                                            @endif
                                        </div>
                                        <div class="event-box-content-items-icons"><em class="bi bi-stopwatch"></em></div>
                                        <div class="event-box-content-items-content">Laufzeit: {{ App\Helpers\Helpers::getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) + 1 }}
                                            @if(App\Helpers\Helpers::getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) != 0)
                                                Tage
                                            @else
                                                Tag
                                            @endif
                                        </div>
                                        <div class="event-box-content-items-icons"><em class="bi bi-geo-alt"></em></div>
                                        <div class="event-box-content-items-content">
                                            <a href="https://maps.google.com/maps?saddr=&daddr={{ $veranstaltungen->veranstaltungsort }}" target="_blank">{{ $veranstaltungen->veranstaltungsort }}</a>
                                        </div>
                                    </div>
                                    @if($veranstaltungen->quelle)
                                        <div class="event-box-webseite">
                                            <a href="{{ route('frontend.veranstaltungen.show', $veranstaltungen->slug) }}">
                                                <em class="bi bi-link-45deg"> Weitere Information</em>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="col-lg-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="rounded shadow no-event">
                        <p class="align-middle text-center fw-bold py-3" style="font-size: 150%;">Es sind leider keine Veranstaltungen eingetragen.</p>
                        <div class="text-center pb-3">
                            <a data-bs-toggle="modal" data-bs-target="#createVeranstaltungModal" class="btn btn-success text-black btn-sm shadow"><em class="bi bi-pencil text-black"></em> Veranstaltung eintragen</a>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
</section>

@extends('layouts.app')

@section('title', 'Kalender')
@section('description')
    {{ strip_tags(Str::limit('Hier kannst du Termine und Werkstattbelegungen ansehen.'), 150) }}
@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="calendar" id="calendar">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="row">
                @if(count($kalenders) > 0)
                <div class="col-lg-12 mt-4">
                    <div class="d-flex justify-content-end">
                        <a href="#" class="btn btn-success text-black btn-sm shadow" data-bs-toggle="modal" data-bs-target="#calendarCreate"><em class="bi bi-pencil text-black"></em> Termin eintragen</a>
                        @hasanyrole('super_admin|admin')
                            <a href="#" class="btn btn-secondary btn-sm shadow ms-3" data-bs-toggle="modal" data-bs-target="#versammlungCreate"><em class="bi bi-pencil"></em> Versammlung eintragen</a>
                        @endhasanyrole
                    </div>
                </div>
                @endif
                @if(count($kalenders) > 0)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="row">
                            @foreach($kalenders as $calender)
                                @if($calender->published)
                                    @if($calender->von <= now())
                                        @include('intern.component.calendar.index')
                                    @elseif($calender->von >= now())
                                        @include('intern.component.calendar.index')
                                    @endif
                                @else
                                    <div class="col-lg-12 mt-4">
                                        <div class="event-box shadow text-bg-danger">
                                            <div class="event-box-time-social" data-aos="flip-down" data-aos-delay="300">
                                                @include('intern.component.calendar.timebox')
                                                @hasanyrole('super_admin|admin')
                                                <div class="event-box-social">
                                                    <form action="{{ route('intern.kalender.update', $calender->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <input type="hidden" name="is_checked" value="1">
                                                        <input type="hidden" name="type" value="{{ $calender->kalendertype->id }}">
                                                        <button type="submit" class="btn btn-link btn-sm p-0"><em class="bi bi-check-circle text-success fw-bold pe-0"></em></button>
                                                    </form>
                                                    <form action="{{ route('intern.kalender.destroy', $calender->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="type" value="{{ $calender->kalendertype->id }}">
                                                        <input type="hidden" name="user_id" value="{{ $calender->team->id }}">
                                                        <button type="submit" class="btn btn-link btn-sm p-0"><em class="bi bi-trash text-danger fw-bold pe-0"></em></button>
                                                    </form>
                                                </div>
                                                @endhasanyrole
                                            </div>
                                            <div class="event-box-content" data-aos="flip-down" data-aos-delay="500">
                                                <h4 @if($calender->type === 'Versammlung') class="text-black" @endif>@if($calender->type === 'Versammlung') Versammlung @else {{ 'Reserviert: ' . $calender->type }} @endif</h4>
                                                <div class="event-box-content-items fw-bold">
                                                    @if($calender->type === 'Versammlung')
                                                        @include('intern.component.calendar.meeting')
                                                    @else
                                                        @include('intern.component.calendar.calendar')
                                                    @endif
                                                </div>
                                                @if($calender->published_at)
                                                    <div class="event-box-webseite">
                                                        <em class="bi bi-clock-fill"> Veröffentlicht am: {{ \Carbon\Carbon::parse($calender->published_at)->isoFormat('DD.MM.YYYY HH:mm') }}</em>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                <div class="rounded shadow no-event">
                                    <p class="align-middle text-center fw-bold p-3" style="font-size: 150%;">Aktuell ist
                                        die Werkstatt frei, du kannst hier einen Wunschtermin eintragen.</p>
                                    <div class="text-center pb-3">
                                        <a href="#" class="btn btn-success text-black btn-sm shadow" data-bs-toggle="modal" data-bs-target="#calendarCreate"><em class="bi bi-pencil text-black"></em> Termin eintragen</a>
                                        @hasanyrole('super_admin|admin')
                                            <a href="#" class="btn btn-secondary btn-sm shadow ms-3" data-bs-toggle="modal" data-bs-target="#versammlungCreate"><em class="bi bi-pencil"></em> Versammlung eintragen</a>
                                        @endhasanyrole
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if(count($veranstaltungens) > 0)
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="row">
                            @foreach($veranstaltungens as $veranstaltungen)
                                <div class="col-lg-12 mt-4">
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
                                                @if($veranstaltungen->eintritt)
                                                    <div class="event-box-content-items-icons">
                                                        <em class="bi bi-ticket-perforated"></em></div>
                                                    <div class="event-box-content-items-content">{{ $veranstaltungen->eintritt }}</div>
                                                @else
                                                    <div class="event-box-content-items-icons">
                                                        <em class="bi bi-ticket-perforated"></em></div>
                                                    <div class="event-box-content-items-content">Kein Eintrittspreis
                                                        bekannt.
                                                    </div>
                                                @endif
                                                <div class="event-box-content-items-icons"><em class="bi bi-clock"></em>
                                                </div>
                                                <div class="event-box-content-items-content">
                                                    @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm'))
                                                        {{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm') . ' Uhr' }}
                                                    @else
                                                        {{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' Uhr' }}
                                                    @endif
                                                </div>
                                                <div class="event-box-content-items-icons">
                                                    <em class="bi bi-stopwatch"></em></div>
                                                <div class="event-box-content-items-content">
                                                    Laufzeit: {{ \App\Helpers\Helpers::getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) + 1 }}
                                                    @if(\App\Helpers\Helpers::getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) != 0)
                                                        Tage
                                                    @else
                                                        Tag
                                                    @endif
                                                </div>
                                                <div class="event-box-content-items-icons">
                                                    <em class="bi bi-geo-alt"></em></div>
                                                <div class="event-box-content-items-content">
                                                    <a href="https://maps.google.com/maps?saddr=&daddr={{ $veranstaltungen->veranstaltungsort }}" target="_blank">{{ $veranstaltungen->veranstaltungsort }}</a>
                                                </div>
                                            </div>
                                            @if($veranstaltungen->quelle)
                                                <div class="event-box-webseite">
                                                    <a href="{{ $veranstaltungen->quelle }}" target="_blank">
                                                        <em class="bi bi-link-45deg"> Weitere Information</em>
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="row">
                            <div class="col-lg-12 mt-4">
                                <div class="rounded shadow no-event">
                                    <p class="align-middle text-center fw-bold p-3" style="font-size: 150%;">Aktuell
                                        haben wir keine passende Veranstaltung, die uns interessiert.</p>
                                    <div class="text-center pb-3">
                                        <a href="{{ url('/#veranstaltungen') }}" class="btn btn-success text-black btn-sm shadow"><em class="bi bi-pencil text-black"></em>
                                            zur Veranstaltungsübersicht</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Modal -->
            <div class="modal fade" id="calendarCreate" tabindex="-1" aria-labelledby="calendarCreateLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="{{ route('intern.kalender.store') }}" method="POST">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="calendarCreateLabel">Kalendereintrag</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="von" class="form-label">Datum + Zeit von:</label>
                                        <input type="datetime-local" class="form-control @error('von') is-invalid @enderror" name="von" id="von" value="{{ old('von') ?: \Carbon\Carbon::parse(now())->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bis" class="form-label">Datum + Zeit bis:</label>
                                        <input type="datetime-local" class="form-control @error('bis') is-invalid @enderror" name="bis" id="bis" value="{{ old('bis') ?: \Carbon\Carbon::parse(now())->addHours(1)->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="col-md-12">
                                        <legend class="col-form-label">Was willst du tun?:</legend>
                                        @foreach($kalenders->type as $type)
                                            @if($type->type !== 'Versammlung')
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="{{ $type->id }}" value="{{ $type->id }}"
                                            @if(old('type', $type->type))
                                                {{ old('type', $type->id) === $kalenders->type[1]->id ? 'checked' : '' }}
                                            @else
                                                {{ 'checked' }}
                                            @endif>
                                            <label class="form-check-label" for="{{ $type->id }}">{{ $type->type }}</label>
                                        </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Beschreibung:</label>
                                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Hier bitte eintragen weshalb du in die Halle möchtest. (Kurz fassen)" value="@if(old('description')) {{ old('description') }} @endif">
                                    </div>
                                    <div class="col-md-6">
                                        <legend class="col-form-label">Eigenes Fahrzeug:</legend>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="eigenesFZ" id="ja" value="Ja" @if(old('eigenesFZ'))
                                                {{ old('type') === 'Ja' ? 'checked' : '' }}
                                                @else
                                                {{ 'checked' }}
                                                @endif>
                                            <label class="form-check-label" for="ja">Ja</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="eigenesFZ" id="nein" value="Nein" @if(old('eigenesFZ'))
                                                {{ old('type') === 'Nein' ? 'checked' : '' }}
                                                @else
                                                {{ '' }}
                                                @endif>
                                            <label class="form-check-label" for="nein">Nein</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                                <button type="submit" class="btn btn-primary"><em class="bi bi-pen"></em> Termin eintragen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="versammlungCreate" tabindex="-1" aria-labelledby="versammlungCreateLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form action="{{ route('intern.kalender.versammlung') }}" method="POST">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="versammlungCreateLabel">Versammlung eintragen</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="von" class="form-label">Datum + Zeit von:</label>
                                        <input type="datetime-local" class="form-control @error('von') is-invalid @enderror" name="von" id="von" value="{{ old('von') ?: \Carbon\Carbon::parse(now())->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="bis" class="form-label">Datum + Zeit bis:</label>
                                        <input type="datetime-local" class="form-control @error('bis') is-invalid @enderror" name="bis" id="bis" value="{{ old('bis') ?: \Carbon\Carbon::parse(now())->addHours(1)->format('Y-m-d\TH:i') }}">
                                    </div>
                                    <div class="col-md-12 d-none">
                                        <legend class="col-form-label">Was willst du tun?:</legend>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="ver" value="1" checked>
                                            <label class="form-check-label" for="ver">Versammlung</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="description" class="form-label">Beschreibung:</label>
                                        <textarea type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Kurze Nachricht an unsere Mitglieder." value="@if(old('description')) {{ old('description') }} @endif"></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Versammlungsort:</label>
                                        <input class="form-control" type="text" name="name" id="name" placeholder="Name" @if(old('name')) {{ old('name') }} @endif>
                                        <label for="straße" class="form-label">&nbsp;</label>
                                        <input class="form-control" type="text" name="straße" id="straße" placeholder="Straße" @if(old('straße')) {{ old('straße') }} @endif>
                                        <label for="ort" class="form-label">&nbsp;</label>
                                        <input class="form-control" type="text" name="ort" id="ort" placeholder="Postleitzahl, Ort" @if(old('ort')) {{ old('ort') }} @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                                <button type="submit" class="btn btn-primary"><em class="bi bi-pen"></em> Versammlung anlegen</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

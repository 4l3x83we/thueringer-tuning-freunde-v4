@extends('layouts.app')

@section('title') {{ Str::limit($veranstaltungen->veranstaltung, 70) }} @endsection
@section('description'){!! strip_tags(Str::limit($veranstaltungen->description, 155)) !!}@endsection
@section('robots', 'INDEX,FOLLOW')

@section('content')
    <!-- ======= Gallery Details Page ======= -->
    <section class="veranstaltungen" id="veranstaltungen" style="min-height: 460px;">
        <div class="container" data-aos="fade">

            <div class="d-flex justify-content-between align-content-center">
                @if(isset($veranstaltungen->previous))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.veranstaltungen.show', $veranstaltungen->previous->slug) }}">
                            <div class="btn-content-title d-inline"><em class="bi bi-chevron-double-left"></em> {{ $veranstaltungen->previous->veranstaltung }}</div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
                <div class="alert alert-link pe-0 ps-0">
                    <a href="{{ route('frontend.index').'#veranstaltungen' }}">
                        <div class="btn-content-title d-inline">Übersicht</div>
                    </a>
                </div>
                @if(isset($veranstaltungen->next))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.veranstaltungen.show', $veranstaltungen->next->slug) }}">
                            <div class="btn-content-title d-inline">{{ $veranstaltungen->next->veranstaltung }} <em class="bi bi-chevron-double-right"></em></div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
            </div>

            <div class="row flex-xl-row-reverse gy-4">

                <div class="col-lg-4">
                    <div class="text-bg-dark shadow border-radius-10 p-4 veranstaltung-sidebar h-100">
                        <h4>
                            <time datetime="{{ $veranstaltungen->datum_von }}">
                                <span class="day">{{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('ddd DD') }}</span>
                                <span class="month">{{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->shortMonthName }}</span>
                                <span class="year">{{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('YYYY') }}</span>
                            </time>
                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('DD.MM.YYYY') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('DD.MM.YYYY'))
                                <em class="bi bi-dash"></em>
                            @endif
                            <time datetime="{{ $veranstaltungen->datum_bis }}">
                                <span class="day">{{ \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('ddd DD') }}</span>
                                <span class="month">{{ \Carbon\Carbon::parse($veranstaltungen->datum_bis)->shortMonthName }}</span>
                                <span class="year">{{ \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('YYYY') }}</span>
                            </time>
                        </h4>
                        <h4>
                            @if(\Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') != \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm'))
                                <em class="bi bi-clock"></em> {{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('HH:mm') . ' Uhr' }}
                            @else
                                <em class="bi bi-clock"></em> {{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('HH:mm') . ' Uhr' }}
                            @endif
                        </h4>
                        <div>Laufzeit: {{ App\Helpers\Helpers::getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) + 1 }}
                            @if(App\Helpers\Helpers::getDaysRate($veranstaltungen->datum_von, $veranstaltungen->datum_bis) != 0)
                                Tage
                            @else
                                Tag
                            @endif
                        </div>
                        <hr>
                        <h4>Ort</h4>
                        <p>{{ $veranstaltungen->veranstaltungsort }}
                            <span class="d-block mb-2"></span>
                            <a href="https://maps.google.com/maps?saddr=&daddr={{ $veranstaltungen->veranstaltungsort }}" target="_blank">
                                <em class="bi bi-geo-alt"></em>
                                Karte
                            </a>
                        </p>
                        <hr>
                        <h4>Veranstalter:</h4>
                        <p>
                            <em class="bi bi-flag"></em> {{ $veranstaltungen->veranstalter }}
                        </p>
                        <hr>
                        <h4>Eintritt:</h4>
                        <p>
                            @if($veranstaltungen->eintritt)
                                <em class="bi bi-ticket-perforated"></em> {{ $veranstaltungen->eintritt }}
                            @else
                                <em class="bi bi-ticket-perforated"></em> Kein Eintrittspreis bekannt.
                            @endif
                        </p>
                        <hr>
                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Veranstaltung bearbeiten"><a data-bs-toggle="modal" data-bs-target="#editVeranstaltungModal" class="links-light-cursor"><em class="bi bi-pen"></em> Bearbeiten</a></span>
                        @hasanyrole('super_admin|admin')
                            @if(!$veranstaltungen->published)
                                <form action="{{ route('frontend.veranstaltungen.published', $veranstaltungen->slug) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="published" value="1">
                                    <button type="submit" class="btn btn-link text-success fw-bold text-decoration-none ps-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Veranstaltung freigeben"><em class="bi bi-check-circle"></em> Veröffentlichen</button>
                                </form>
                                <form action="{{ route('frontend.veranstaltungen.destroy', $veranstaltungen->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger fw-bold text-decoration-none ps-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Veranstaltung löschen"><em class="bi bi-trash"></em> Löschen</button>
                                </form>
                            @else
                                <form action="{{ route('frontend.veranstaltungen.published', $veranstaltungen->slug) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="published" value="0">
                                    <button type="submit" class="btn btn-link text-info fw-bold text-decoration-none ps-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Veranstaltung verbergen"><em class="bi bi-x-circle"></em> Verbergen</button>
                                </form>
                                <form action="{{ route('frontend.veranstaltungen.destroy', $veranstaltungen->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger fw-bold text-decoration-none ps-0" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Veranstaltung löschen"><em class="bi bi-trash"></em> Löschen</button>
                                </form>
                            @endif
                        @endhasanyrole
                    </div>
                </div>

                <div class="col-lg-8 galerie-details-list">
                    <div class="text-bg-dark shadow border-radius-10 p-4 veranstaltung-desc h-100">
                        <h4>{{ $veranstaltungen->veranstaltung }}</h4>
                        <hr>
                        @if($veranstaltungen->description)
                            <h5>Beschreibung:</h5>
                            {!! $veranstaltungen->description !!}
                        @else
                            <p>Beschreibung folgt in Kürze.</p>
                        @endif
                        <hr>
                        @if($veranstaltungen->quelle)
                            <div class="mt-4">
                                Link: <a href="{{ $veranstaltungen->quelle }}" class="links-light" target="_blank"><em class="bi bi-link-45deg"></em> mehr Informationen</a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-between align-content-center mt-4">
                @if(isset($veranstaltungen->previous))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.veranstaltungen.show', $veranstaltungen->previous->slug) }}">
                            <div class="btn-content-title d-inline"><em class="bi bi-chevron-double-left"></em> {{ $veranstaltungen->previous->veranstaltung }}</div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
                <div class="alert alert-link pe-0 ps-0">
                    <a href="{{ route('frontend.index').'#veranstaltungen' }}">
                        <div class="btn-content-title d-inline">Übersicht</div>
                    </a>
                </div>
                @if(isset($veranstaltungen->next))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.veranstaltungen.show', $veranstaltungen->next->slug) }}">
                            <div class="btn-content-title d-inline">{{ $veranstaltungen->next->veranstaltung }} <em class="bi bi-chevron-double-right"></em></div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
            </div>

        </div>

        @include('frontend.component.events.edit')
    </section>
@endsection

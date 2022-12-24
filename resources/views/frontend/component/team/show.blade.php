@extends('layouts.app')

@section('title'){{ $team->title }}@endsection
@section('description'){!! strip_tags(Str::limit($team->description, 150)) !!}@endsection
@section('robots', 'INDEX,FOLLOW')
@section('images'){{ asset($team->images) }}@endsection

@section('content')
    <!-- ======= Team Details Page ======= -->
    <section class="team" id="team">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h1 class="d-none">@yield('description')</h1>
                <h2>@yield('title')</h2>
                <p>Mitglied seit: {{ \Carbon\Carbon::parse($team->published_at)->format('d.m.Y') }}</p>
            </div>

            <div class="d-flex justify-content-between align-content-center">
                @if(isset($team->previous))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.team.show', $team->previous->slug) }}">
                            <div class="btn-content-title d-inline"><em class="bi bi-chevron-double-left"></em> {{ $team->previous->title }}</div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.team.index') }}">
                            <div class="btn-content-title d-inline">Übersicht</div>
                        </a>
                    </div>
                @if(isset($team->next))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.team.show', $team->next->slug) }}">
                            <div class="btn-content-title d-inline">{{ $team->next->title }} <em class="bi bi-chevron-double-right"></em></div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
            </div>

            <div class="row g-4 flex-lg-row-reverse teamDetails text-bg-dark shadow border-radius-10">

                <div class="col-lg-4 col-md-6">
                    <div class="entry">

                        <div class="sidebar">
                            <div class="d-flex justify-content-between align-items-center lh-1" data-aos="fade-left" data-aos-delay="100">
                                <h2 class="m-0">Über mich</h2>
                                @can('edit')
                                    @hasanyrole('super_admin|admin')
                                        @if(auth()->user()->id !== $team->user_id)
                                            <a data-bs-toggle="modal" data-bs-target="#teamEditModal"><em class="bi bi-pencil"></em> Bearbeiten</a>
                                        @endif
                                    @endhasanyrole
                                    @if(auth()->user()->id === $team->user_id)
                                        <a data-bs-toggle="modal" data-bs-target="#teamEditModal"><em class="bi bi-pen"></em> Bearbeiten</a>
                                    @endif
                                @endcan
                                @if($team->photo_id)
                                    <img src="{{ asset('images/default.png') }}" data-src="{{ asset($team->images) }}" class="profilImage shadow-sm lozad" alt="{{ $team->title }}">
                                @else
                                    <div class="profilImage shadow-sm text-bg-success">{!! \App\Helpers\Helpers::teamInitial($team) !!}</div>
                                @endif
                            </div>
                            <hr data-aos="fade-left" data-aos-delay="100">
                            <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="200">
                                <div class="d-flex">
                                    <h5 style="width: 100px;">Name:</h5>
                                    <h5>
                                        <span class="d-inline" id="vorname" style="font-size: 1.125rem;">{{ $team->vorname }}</span>
                                        <span class="d-inline" id="nachname" style="font-size: 1.125rem;">{{ $team->nachname }}</span>
                                    </h5>
                                </div>
                                <div class="d-flex">
                                    <span style="width: 100px;">Alter:</span>
                                    <span>{{ $team->gebdatum }}</span>
                                </div>
                                <div class="d-flex">
                                    <span style="width: 100px;">Funktion:</span>
                                    <span>{{ $team->funktion }}</span>
                                </div>
                                <div class="d-flex">
                                    <span style="width: 100px;">Wohnort:</span>
                                    <span>{{ $team->wohnort }}</span>
                                </div>
                                <div class="d-flex">
                                    <span style="width: 100px;">Kontakt:</span>
                                    <span>
                                        <a href="mailto:{{ $team->emailIntern }}" target="_blank"><em class="bi bi-envelope"></em> Schreib mir</a>
                                    </span>
                                </div>
                                <div class="d-flex">
                                    <span style="width: 100px;">Beruf:</span>
                                    <span>{{ $team->beruf }}</span>
                                </div>
                                @if(count($team->fahrzeuges) > 0)
                                    <div class="d-flex">
                                        <span style="width: 100px;">Fahrzeuge:</span>
                                        <span>
                                            @foreach($team->fahrzeuges as $fahrzeug)
                                                <div class="show-fahrzeuge">
                                                    <a href="{{ url('fahrzeuge/'. $fahrzeug->slug) }}">{{ $fahrzeug->fahrzeug }}</a>
                                                </div>
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                @if(count($team->albums) > 0)
                                    <div class="d-flex">
                                        <span style="width: 100px;">Alben:</span>
                                        <span>
                                            @foreach($team->albums as $album)
                                                @if($album->published)
                                                    <div class="show-fahrzeuge">
                                                        <a href="{{ url('galerie/'. $album->slug) }}">{{ $album->title }}</a>
                                                    </div>
                                                @else
                                                    <div class="show-fahrzeuge">
                                                        <span><del>{{ $album->title }}</del></span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                            </div>

                            @if($team->facebook or $team->tiktok or $team->instagram)
                                <hr data-aos="fade-left" data-aos-delay="200">
                                <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="300">
                                    <div class="col-lg-12 p-0">
                                        <div class="social">
                                            @if ($team->tiktok)
                                                <a href="{{ '//www.tiktok.com/'.$team->tiktok }}" target="_blank">
                                                    <em class="bi bi-tiktok"></em>
                                                </a>
                                            @endif
                                            @if ($team->facebook)
                                                <a href="{{ '//www.facebook.com/'.$team->facebook }}" target="_blank">
                                                    <em class="bi bi-facebook"></em>
                                                </a>
                                            @endif
                                            @if ($team->instagram)
                                                <a href="{{ '//www.instagram.com/'.$team->instagram.'/' }}" target="_blank">
                                                    <em class="bi bi-instagram"></em>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <hr data-aos="fade-left" data-aos-delay="300">
                            <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="400">
                                <span>Erstellt am: {{ \Carbon\Carbon::parse($team->published_at)->format('d.m.Y') }}</span>
                                <span>Letzte Änderungen: {{ \Carbon\Carbon::parse($team->updated_at)->fromNow() }}</span>
                            </div>

                            @hasanyrole('super_admin|admin')
                            <hr data-aos="fade-left" data-aos-delay="500">
                            <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="500">
                                <div class="col-lg-12 p-0">
                                    <form action="{{ route('frontend.team.destroy', $team->slug) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="fullname" value="{{ $team->vorname . ' ' . $team->nachname }}">
                                        @foreach($team->albums as $album)
                                            <input type="hidden" name="albumDirectory[{{ $album->id }}]" value="{{ explode($album->slug.'/', $album->images)[0].$album->slug }}">
                                        @endforeach
                                        @foreach($team->photos as $photo)
                                            <input type="hidden" name="photo[{{ $photo->id }}]" value="{{ explode($photo->slug.'/', $photo->images)[0] }}">
                                        @endforeach
                                        <button type="submit" class="btn btn-danger btn-sm"><em class="bi bi-trash"></em> Löschen</button>
                                    </form>
                                </div>
                            </div>
                            @endhasanyrole

                            @hasanyrole('mitglied|silent member')
                            @if(auth()->user()->id === $team->user_id)
                            <hr data-aos="fade-left" data-aos-delay="500">
                            <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="500">
                                <div class="col-lg-12 p-0">
                                    <form action="{{ route('frontend.team.updateMember', $team->slug) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        @foreach($team->albums as $album)
                                            <input type="hidden" name="albumID[{{ $album->id }}]" value="{{ $album->id }}">
                                        @endforeach
                                        @foreach($team->photos as $photo)
                                            <input type="hidden" name="photoID[{{ $photo->id }}]" value="{{ $photo->id }}">
                                        @endforeach
                                        @foreach($team->fahrzeuge as $fahrzeug)
                                            <input type="hidden" name="fahrzeugID[{{ $fahrzeug->id }}]" value="{{ $fahrzeug->id }}">
                                        @endforeach
                                        <button type="submit" class="btn btn-danger btn-sm"><em class="bi bi-trash"></em> Löschen</button>
                                    </form>
                                </div>
                            </div>
                            @endif
                            @endhasanyrole
                        </div>

                    </div>
                </div>

                <div class="col-lg-8 col-md-6" data-aos="fade-up">
                    <div class="entry">
                        <article class="p-3">{!! $team->description !!}</article>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-content-center">
                @if(isset($team->previous))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.team.show', $team->previous->slug) }}">
                            <div class="btn-content-title d-inline"><em class="bi bi-chevron-double-left"></em> {{ $team->previous->title }}</div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
                <div class="alert alert-link pe-0 ps-0">
                    <a href="{{ route('frontend.team.index') }}">
                        <div class="btn-content-title d-inline">Übersicht</div>
                    </a>
                </div>
                @if(isset($team->next))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.team.show', $team->next->slug) }}">
                            <div class="btn-content-title d-inline">{{ $team->next->title }} <em class="bi bi-chevron-double-right"></em></div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
            </div>
        </div>
        <!-- ======= Edit Modal ======= -->
        @include('frontend.component.team.edit')
    </section>
@endsection



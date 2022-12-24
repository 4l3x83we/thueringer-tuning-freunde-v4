@extends('layouts.app')

@section('title'){{ $fahrzeuge->title }}@endsection
@section('description'){!! strip_tags(Str::limit($fahrzeuge->description, 150)) !!}@endsection
@section('robots', 'INDEX,FOLLOW')
@section('images'){{ asset($fahrzeuge->images) }}@endsection

@section('content')
    <!-- ======= fahrzeuge Details Page ======= -->
    <section class="fahrzeuge" id="fahrzeuge">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <h1 class="d-none">@yield('description')</h1>
            </div>

            <div class="d-flex justify-content-between align-content-center">
                @if(isset($fahrzeuge->previous))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->previous->slug) }}">
                            <div class="btn-content-title d-inline"><em class="bi bi-chevron-double-left"></em> {{ $fahrzeuge->previous->title }}</div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.fahrzeuge.index') }}">
                            <div class="btn-content-title d-inline">Übersicht</div>
                        </a>
                    </div>
                @if(isset($fahrzeuge->next))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->next->slug) }}">
                            <div class="btn-content-title d-inline">{{ $fahrzeuge->next->title }} <em class="bi bi-chevron-double-right"></em></div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
            </div>

            <div class="row flex-xl-row-reverse fahrzeugeDetails text-bg-dark shadow border-radius-10">

                <div class="col-xl-4">
                    <div class="entry my-3">

                        <div class="sidebar">
                            <div class="d-flex justify-content-between align-items-center lh-1" data-aos="fade-left" data-aos-delay="100">
                                <h2 class="m-0">Fahrzeugdaten</h2>
                                @can('edit')
                                    @hasanyrole('super_admin|admin')
                                        @if(auth()->user()->id !== $fahrzeuge->user_id)
                                            <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}" class="links-light"><em class="bi bi-pencil"></em> Bearbeiten</a>
                                        @endif
                                    @endhasanyrole
                                    @if(auth()->user()->id === $fahrzeuge->user_id)
                                        <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}" class="links-light"><em class="bi bi-pen"></em> Bearbeiten</a>
                                    @endif
                                @endcan
                            </div>
                            <hr data-aos="fade-left" data-aos-delay="100">
                            <div class="row m-0 w-100 fd" data-aos="fade-left" data-aos-delay="200">
                                <div class="d-flex">
                                    <span style="min-width: 130px;">Fahrzeug:</span>
                                    <span>{!! $fahrzeuge->title !!}</span>
                                </div>
                                <div class="d-flex">
                                    <span style="min-width: 130px;">Baujahr:</span>
                                    <span>{{ $fahrzeuge->baujahr }}</span>
                                </div>
                                <div class="d-flex">
                                    <span style="min-width: 130px;">Besonderheiten:</span>
                                    <span>{!! $fahrzeuge->besonderheiten !!}</span>
                                </div>
                                <div class="d-flex">
                                    <span style="min-width: 130px;">Motor:</span>
                                    <span>{!! $fahrzeuge->motor !!}</span>
                                </div>
                                @if(isset($team))
                                    <div class="d-flex">
                                        <span style="min-width: 130px;">Mitglied:</span>
                                        <span>
                                            <div class="show-fahrzeuge">
                                                <a href="{{ route('frontend.team.show', $team->slug) }}">{{ $team->title }}</a>
                                            </div>
                                        </span>
                                    </div>
                                @else
                                    <div class="d-flex">
                                        <span class="text-danger fw-bold trennung">Das Fahrzeug kann keinem Teammitglied zugeordnet werden.</span>
                                    </div>
                                @endif
                            </div>

                            <hr data-aos="fade-left" data-aos-delay="200">
                            <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="300">
                                <span>Erstellt am: {{ \Carbon\Carbon::parse($fahrzeuge->published_at)->format('d.m.Y') }}</span>
                                <span>Letzte Änderungen: {{ \Carbon\Carbon::parse($fahrzeuge->updated_at)->fromNow() }}</span>
                            </div>

                            @if($fahrzeuge->published)
                                <hr data-aos="fade-left" data-aos-delay="300">
                                <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="400">
                                    <div class="col-xl-12 p-0">
                                        @can('edit')
                                            @if($fahrzeuge->user_id === auth()->user()->id)
                                                <form action="{{ route('frontend.fahrzeuge.unpublished', $fahrzeuge->slug) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm"><em class="bi bi-trash3"></em> Fahrzeug ausblenden</button>
                                                </form>
                                            @else
                                                <form action="{{ route('frontend.fahrzeuge.unpublished', $fahrzeuge->slug) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm"><em class="bi bi-trash3"></em> Fahrzeug ausblenden</button>
                                                </form>
                                            @endif
                                        @endcan
                                    </div>
                                </div>
                            @else
                                <hr data-aos="fade-left" data-aos-delay="300">
                                <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="400">
                                    <div class="col-xl-12 p-0">
                                        @can('edit')
                                            @if($fahrzeuge->user_id === auth()->user()->id)
                                                <form action="{{ route('frontend.fahrzeuge.published', $fahrzeuge->slug) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm"><em class="bi bi-check-circle"></em> Fahrzeug einblenden</button>
                                                </form>
                                            @else
                                                <form action="{{ route('frontend.fahrzeuge.published', $fahrzeuge->slug) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm"><em class="bi bi-check-circle"></em> Fahrzeug einblenden</button>
                                                </form>
                                            @endif
                                        @endcan
                                    </div>
                                </div>
                            @endif

                            @can('destroy')
                            <hr data-aos="fade-left" data-aos-delay="500">
                            <div class="row m-0 w-100" data-aos="fade-left" data-aos-delay="600">
                                <div class="col-xl-12 p-0">
                                    @if($fahrzeuge->user_id === auth()->user()->id)
                                        @if(count($photos) > 0)
                                            @if(auth()->user()->hasAnyRole('super_admin', 'admin'))
                                                @if($published)
                                                    @include('frontend.component.fahrzeuge.forms.photoPublished')
                                                @endif
                                            @endif
                                        @endif
                                        @include('frontend.component.fahrzeuge.forms.destroy')
                                    @else
                                        @hasanyrole('super_admin|admin')
                                            <span>Adminmenü</span>
                                            @if(count($photos) > 0)
                                                @if($published)
                                                    @include('frontend.component.fahrzeuge.forms.photoPublished')
                                                @endif
                                            @endif
                                            @include('frontend.component.fahrzeuge.forms.destroy')
                                        @endhasanyrole
                                    @endif
                                </div>
                                @if(count($photos) > 0)
                                <div class="col-xl-12 py-3 px-0">
                                    <div class="fahrzeug-img-unpublished d-flex flex-wrap justify-content-start align-content-center">
                                    @foreach($photos as $photo)
                                        @if(empty($photo->published))
                                            <div class="inner">
                                                <div class="thumbnails">
                                                    <a href="{{ asset($fahrzeuge->path.'/'.$photo->images) }}" data-fancybox="images" data-caption="@if ($photo->description) {{ $photo->description }} @else {{ $photo->title }} @endif">
                                                        <img src="{{ asset('images/default.png') }}" data-src="{{ asset($fahrzeuge->path.'/'.$photo->images_thumbnail) }}" alt="@if($photo->description) {!! $photo->description !!} @else {!! $photo->title !!} @endif" title="Anhang: @if($photo->description) {!! $photo->description !!} @else {!! $photo->title !!} @endif" class="img-fluid lozad">
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                            @endcan
                        </div>

                    </div>
                </div>

                <div class="col-xl-8" data-aos="fade-up">
                    @if(empty($album->thumbnail_id))
                        <div class="background shadow" style="background-image: url('{{ asset('images/default.png') }}');">
                            <div class="background-text d-flex justify-content-between align-items-center">
                                <div style="margin: 20px 0;">
                                    <h1 class="align-content-center">{{ Str::limit($fahrzeuge->title, 30) }}</h1>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="background shadow" style="background-image: url('{{ asset($fahrzeuge->path.'/'.$preview->images_thumbnail) }}');">
                            <div class="background-text d-flex justify-content-between align-items-center">
                                <h1>{{ Str::limit($fahrzeuge->title, 30) }}</h1>
                                <img src="{{ asset('images/default.png') }}" data-src="{{ asset($fahrzeuge->path.'/'.$preview->images_thumbnail) }}" class="img-fluid shadow lozad" alt="{{ $fahrzeuge->title }}">
                            </div>
                        </div>
                    @endif
                    <div class="mb-4">
                        <div class="text-bg-dark-1" data-aos="fade-left">
                            <h4>Karosserie:</h4>
                        </div>
                        <div class="text">{!! $fahrzeuge->karosserie !!}</div>
                        <div class="text-bg-dark-1" data-aos="fade-left">
                            <h4>Fahrwerk:</h4>
                        </div>
                        <div class="text">{!! $fahrzeuge->fahrwerk !!}</div>
                        <div class="text-bg-dark-1" data-aos="fade-left">
                            <h4>Felgen:</h4>
                        </div>
                        <div class="text">{!! $fahrzeuge->felgen !!}</div>
                        <div class="text-bg-dark-1" data-aos="fade-left">
                            <h4>Bremsen:</h4>
                        </div>
                        <div class="text">{!! $fahrzeuge->bremsen !!}</div>
                        <div class="text-bg-dark-1" data-aos="fade-left">
                            <h4>Innenraum:</h4>
                        </div>
                        <div class="text">{!! $fahrzeuge->innenraum !!}</div>
                        <div class="text-bg-dark-1" data-aos="fade-left">
                            <h4>Anlage:</h4>
                        </div>
                        <div class="text">{!! $fahrzeuge->anlage !!}</div>
                        <div class="text-bg-dark-1" data-aos="fade-left">
                            <h4>Beschreibung:</h4>
                        </div>
                        <div class="text">
                            {!! $fahrzeuge->description !!}
                        </div>
                    </div>
                </div>

            </div>

            @if(count($photos) > 0)
            <div class="row mt-3">

                <div class="col-xl-12 py-3 text-bg-dark shadow border-radius-10 album-fahrzeug-list">
                    <div class="fahrzeug-img d-flex flex-wrap justify-content-center align-content-center">
                    @foreach($photos as $photo)
                        @if($photo and $photo->published_at <= now() and $photo->published)
                            @if(empty($photo->images))
                                <div class="inner">
                                    <div class="thumbnails">
                                        <a href="{{ asset('images/default.png') }}" data-fancybox="images" data-caption="@if ($photo->description) {{ $photo->description }} @else {{ $photo->title }} @endif">
                                            <img src="{{ asset('images/default.png') }}" alt="@if($photo->description) {!! $photo->description !!} @else {!! $photo->title !!} @endif" title="Anhang: @if($photo->description) {!! $photo->description !!} @else {!! $photo->title !!} @endif" class="img-fluid lozad">
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="inner">
                                    <div class="thumbnails">
                                        <a href="{{ asset($fahrzeuge->path.'/'.$photo->images) }}" data-fancybox="images" data-caption="@if ($photo->description) {{ $photo->description }} @else {{ $photo->title }} @endif">
                                            <img src="{{ asset('images/default.png') }}" data-src="{{ asset($fahrzeuge->path.'/'.$photo->images_thumbnail) }}" alt="@if($photo->description) {!! $photo->description !!} @else {!! $photo->title !!} @endif" title="Anhang: @if($photo->description) {!! $photo->description !!} @else {!! $photo->title !!} @endif" class="img-fluid lozad">
                                        </a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endforeach
                    </div>
                </div>

            </div>
            @endif

            <div class="d-flex justify-content-between align-content-center">
                @if(isset($fahrzeuge->previous))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->previous->slug) }}">
                            <div class="btn-content-title d-inline"><em class="bi bi-chevron-double-left"></em> {{ $fahrzeuge->previous->title }}</div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
                <div class="alert alert-link pe-0 ps-0">
                    <a href="{{ route('frontend.fahrzeuge.index') }}">
                        <div class="btn-content-title d-inline">Übersicht</div>
                    </a>
                </div>
                @if(isset($fahrzeuge->next))
                    <div class="alert alert-link pe-0 ps-0">
                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->next->slug) }}">
                            <div class="btn-content-title d-inline">{{ $fahrzeuge->next->title }} <em class="bi bi-chevron-double-right"></em></div>
                        </a>
                    </div>
                @else
                    <div></div>
                @endif
            </div>
        </div>
    </section>

@endsection

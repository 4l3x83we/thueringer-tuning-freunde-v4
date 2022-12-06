@extends('layouts.app')

@section('title', 'Galerie')
@section('description'){!! Str::limit('Hier siehst du eine übersicht über unsere Bilder.', 150) !!}@endsection
@section('robots', 'INDEX,FOLLOW')

@section('content')
    <!-- ======= Gallery Page ======= -->
    <section class="galerie" id="galerie">
        <div class="container" data-aos="fade-up">

            @if(count($albums) > 0)
                <div class="row ">
                    <div class="col-lg-12 d-flex justify-content-center" data-aos="fade-up">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">Alle</li>
                            @foreach($albums->kategorie as $kategorie)
                                <li data-filter=".filter-{{ $kategorie->kategorie }}">{{ \App\Helpers\Helpers::replaceBlankMinus($kategorie->kategorie) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container " data-aos="fade-up">
                    @foreach($albums as $album)
                        <div class="col-lg-3 col-md-6 portfolio-item filter-{{ $album->kategorie }}">
                            <a href="{{ route('frontend.galerie.show', $album->slug) }}" title="Galerie anzeigen: {{ $album->title }}">
                                <div class="portfolio-wrap shadow border-radius-10">
                                    <div class="portfolio-img">
                                        @if($album->thumbnail_id)
                                            @foreach($albums->images_thumbnail as $thumbnail)
                                                <img src="{{ asset('images/default.png') }}" data-src="{{ $thumbnail }}" alt="{{ $album->title }}" class="img-fluid lozad">
                                            @endforeach
                                        @else
                                            <img src="{{ asset('images/default.png') }}" alt="{{ $album->title }}" class="img-fluid lozad">
                                        @endif
                                    </div>
                                    <div class="portfolio-info">
                                        <h4>{!! strip_tags(Str::limit($album->title, 30)) !!}</h4>
                                        <p>{!! strip_tags(Str::limit($album->description, 30)) !!}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            {!! $albums->appends(Request::all())->render() !!}
                            <div class="well">
                                <div class="list-unstyled">
                                    <small>Alben insgesamt: {!! $albums->total() !!}</small> |
                                    @if($albums->count() > 21)
                                        <small>Auf dieser Seite: {!! $albums->count() !!}</small> |
                                    @endif
                                    @if($albums->lastPage() > 1)
                                        <small>Alle Seiten: {!! $albums->lastPage() !!}</small> |
                                    @endif
                                    <small>Photos insgesamt: {!! $albums->photos !!}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row portfolio-container" data-aos="fade-up">
                    <div class="col-lg-12 portfolio-item" style="height: 317px;">
                        <div class="portfolio-wrap">
                            <p class="align-middle text-center font-weight-bold mt-3" style="font-size: 150%;">Es sind noch keine Alben vorhanden.</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection

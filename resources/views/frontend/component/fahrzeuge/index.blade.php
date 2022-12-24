@extends('layouts.app')

@section('title', 'Fahrzeuge')
@section('description'){!! Str::limit('Hier siehst du eine Übersicht über unsere aktuellen Fahrzeuge.', 150) !!}@endsection
@section('robots', 'INDEX,FOLLOW')

@section('content')
    <!-- ======= Team Details Page ======= -->
    <section class="fahrzeuge" id="fahrzeuge">
        <div class="container" data-aos="fade-up">
            <h1 class="d-none">@yield('description')</h1>
            <div class="row">
            @if(count($fahrzeuges) > 0)
                @foreach($fahrzeuges as $fahrzeuge)
                    @if($fahrzeuge->published)
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                            <div class="member shadow-sm" data-aos="zoom-in" data-aos-delay="100">
                                <div class="member-img">
                                    @if(empty($fahrzeuge->albums->thumbnail_id))
                                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}">
                                            <img src="{{ asset('images/default.png') }}" alt="{{ $fahrzeuge->title }}" class="img-fluid lozad">
                                        </a>
                                    @else
                                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}">
                                            @if($fahrzeuge->albums->thumbnail_id)
                                                <img src="{{ asset('images/default.png') }}" data-src="{{ $fahrzeuge->path.'/'.$preview[$fahrzeuge->id]->images_thumbnail }}" alt="{{ $fahrzeuge->title }}" class="img-fluid lozad">
                                            @endif
                                        </a>
                                    @endif
                                </div>
                                <div class="member-info">
                                    <h4>{{ $fahrzeuge->title }}</h4>
                                    <p>{!! strip_tags(Str::limit($fahrzeuge->description, 120)) !!}</p>
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}" id="member-link"><em class="bi bi-link-45deg"></em> zum Fahrzeug</a>
                                        @can('edit')
                                            @hasanyrole('super_admin|admin')
                                                @if(auth()->user()->id !== $fahrzeuge->user_id)
                                                    <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}" id="member-link"><em class="bi bi-pen"></em> Fahrzeug bearbeiten</a>
                                                @endif
                                            @endhasanyrole
                                            @if(auth()->user()->id === $fahrzeuge->user_id)
                                                <a href="{{ route('frontend.fahrzeuge.edit', $fahrzeuge->slug) }}" id="member-link"><em class="bi bi-pen"></em> Fahrzeug bearbeiten</a>
                                            @endif
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-end align-items-center">
                        <small>Mitglieder insgesamt: {!! $fahrzeuges->total() !!}</small>&nbsp;|&nbsp;
                        @if($fahrzeuges->count() !== $fahrzeuges->total())
                        <small>Auf dieser Seite: {!! $fahrzeuges->count() !!}</small>&nbsp;|&nbsp;
                        @endif
                        <small>Alle Seiten: {!! $fahrzeuges->lastPage() !!}</small>
                    </div>
                    <div class="mt-3">
                        {{ $fahrzeuges->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

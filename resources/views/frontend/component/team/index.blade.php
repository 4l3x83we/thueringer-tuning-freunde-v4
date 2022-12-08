@extends('layouts.app')

@section('title', 'Team')
@section('description'){!! Str::limit('Hier siehst du eine Übersicht über unsere aktuellen Mitglieder.', 150) !!}@endsection
@section('robots', 'INDEX,FOLLOW')

@section('content')
    <!-- ======= Team Details Page ======= -->
    <section class="team" id="team">
        <div class="container" data-aos="fade-up">

            <div class="row">
            @if(count($teams) > 0)
                @foreach($teams as $team)
                    @if(\Carbon\Carbon::parse($team->published_at) <= \Carbon\Carbon::now())
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                            <div class="member shadow-sm" data-aos="zoom-in" data-aos-delay="100">
                                <div class="member-img">
                                    @if($team->image == true)
                                        <a href="{{ route('frontend.team.show', $team->slug) }}"><img src="{{ asset('images/default.png') }}" data-src="{{ $team->image }}" alt="{{ $team->vorname .' '. $team->nachname }}" class="img-fluid lozad"></a>
                                    @else
                                        <div class="member-img-background">
                                            <a href="{{ route('frontend.team.show', $team->slug) }}"><div class="member-img-abbreviation">{!! \App\Helpers\Helpers::teamInitials($teams)[$team->id] !!}</div></a>
                                        </div>
                                    @endif
                                    @if($team->facebook == true or $team->tiktok == true or $team->instagram == true)
                                        <div class="social">
                                            @if($team->tiktok == true)
                                                <a href="https://www.tiktok.com/{{ $team->tiktok }}"
                                                   target="_blank"><em class="bi bi-tiktok"></em></a>
                                            @endif
                                            @if($team->facebook == true)
                                                <a href="https://www.facebook.com/{{ $team->facebook }}"
                                                   target="_blank"><em class="bi bi-facebook"></em></a>
                                            @endif
                                            @if($team->instagram == true)
                                                <a href="https://www.instagram.com/{{ $team->instagram }}/"
                                                   target="_blank"><em class="bi bi-instagram"></em></a>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <div class="member-info">
                                    <h4>{{ $team->vorname .' '. $team->nachname }}</h4>
                                    <span class="text-muted">{{ $team->funktion }}</span>
                                    <p>{!! strip_tags(Str::limit($team->description, 120)) !!}</p>
                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('frontend.team.show', $team->slug) }}" id="member-link"><em class="bi bi-link-45deg"></em> Über mich</a>
                                        @can('edit')
                                            @hasanyrole('super_admin|admin')
                                            @if(auth()->user()->id !== $team->user_id)
                                                <a href="{{ route('frontend.team.edit', $team->slug) }}" id="member-link"><em class="bi bi-pen"></em> Bearbeiten</a>
                                            @endif
                                            @endhasanyrole
                                            @if(auth()->user()->id === $team->user_id)
                                                <a href="{{ route('frontend.team.edit', $team->slug) }}" id="member-link"><em class="bi bi-pen"></em> Über mich bearbeiten</a>
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
                        <small>Mitglieder insgesamt: {!! $teams->total() !!}</small>&nbsp;|&nbsp;
                        @if($teams->count() !== $teams->total())
                        <small>Auf dieser Seite: {!! $teams->count() !!}</small>&nbsp;|&nbsp;
                        @endif
                        <small>Alle Seiten: {!! $teams->lastPage() !!}</small>
                    </div>
                    <div class="mt-3">
                        {{ $teams->links() }}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

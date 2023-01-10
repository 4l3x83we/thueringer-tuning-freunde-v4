<section class="team" id="team">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
            <h2>Team</h2>
        </div>

        <div class="row">

            <div class="slider swiper" style="padding-bottom: 1.875rem;">
                <div class="swiper-wrapper">

                    @if(count($teams) > 0)
                        @foreach($teams as $team)
                            @if(\Carbon\Carbon::parse($team->published_at) <= \Carbon\Carbon::now())
                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch swiper-slide px-3 px-md-0">
                                    <div class="member shadow-sm" data-aos="zoom-in" data-aos-delay="100">
                                        <div class="member-img">
                                            @if(!empty($team->photo_id))
                                                <a href="{{ route('frontend.team.show', $team->slug) }}"><img src="{{ asset('images/default.png') }}" data-src="{{ $previewTeam[$team->id] }}" alt="{{ $team->vorname .' '. $team->nachname }}" class="img-fluid swiper-lazy lozad"></a>
                                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
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
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </div>
</section>

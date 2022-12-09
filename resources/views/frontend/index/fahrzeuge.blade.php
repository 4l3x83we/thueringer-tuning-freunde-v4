<section class="fahrzeuge text-bg-dark" id="fahrzeuge">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
            <h2>Fahrzeuge</h2>
        </div>

        <div class="row">

            <div class="slider swiper" style="padding-bottom: 1.875rem;">
                <div class="swiper-wrapper">

                    @if(count($fahrzeuges) > 0)
                        @foreach($fahrzeuges as $fahrzeuge)
                            @if($fahrzeuge->published)
                                <div class="col-lg-3 col-md-6 d-flex align-items-stretch swiper-slide">
                                    <div class="member shadow-sm" data-aos="zoom-in" data-aos-delay="100">
                                        <div class="member-img">
                                            @if(empty($fahrzeuge->albums->thumbnail_id))
                                                <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}">
                                                    <img src="{{ asset('images/default.png') }}" data-src="{{ asset('images/default.png') }}" alt="{{ $fahrzeuge->title }}" class="img-fluid swiper-lazy lozad">
                                                </a>
                                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
                                            @else
                                                <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}">
                                                    <img src="{{ asset('images/default.png') }}" data-src="{{ $albums->preview[$fahrzeuge->album_id] }}" alt="{{ $fahrzeuge->title }}" class="img-fluid swiper-lazy lozad">
                                                </a>
                                                <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
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
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </div>
</section>

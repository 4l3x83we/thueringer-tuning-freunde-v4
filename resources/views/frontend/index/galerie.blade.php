<section class="galerie" id="galerie">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
            <h2>Galerie</h2>
        </div>

        <div class="slider swiper">
            <div class="swiper-wrapper">

                @if(count($albums) > 0)
                    @foreach($albums as $album)
                        <div class="swiper-slide galerie-item">
                            <div class="galerie-wrapper">
                                @if($album->thumbnail_id)
                                    <img src="{{ asset('images/default.png') }}" data-src="{{ $preview[$album->id] }}" alt="{{ $album->title }}" class="img-fluid shadow swiper-lazy lozad">
                                @else
                                    <img src="{{ asset('images/default.png') }}" alt="{{ $album->title }}" class="img-fluid shadow swiper-lazy imgDefault lozad">
                                @endif
                                <div class="galerie-info">
                                    <h4>{!! strip_tags(Str::limit($album->title, 30)) !!}</h4>
                                    <p>{!! strip_tags(Str::limit($album->description, 30)) !!}</p>
                                    <div class="galerie-links">
                                        <a href="{{ route('frontend.galerie.show', $album->slug) }}" title="zum Album"><em class="bi bi-link-45deg"></em></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>

    </div>
</section>

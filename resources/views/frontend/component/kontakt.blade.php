{{--@include('helpers.component.recaptcha')--}}

<section class="kontakt pb-0" id="kontakt">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
            <h2>Kontakt</h2>
        </div>

    </div>

    <div>
        <a href="https://www.google.de/maps/place/Th%C3%BCringer+Tuning+Freunde/@51.1431979,11.1046222,17z/data=!3m1!4b1!4m6!3m5!1s0x47a405bfa95dab67:0x95ced3453404d44a!8m2!3d51.1431946!4d11.1068162!16s%2Fg%2F11gnp4wp6x" target="_blank"><img src="{{ asset('images/default.png') }}" data-src="{{ Vite::asset('resources/images/googleMaps.png') }}" alt="GoogleMaps" title="Google Maps" class="img-fluid lozad"></a>
    </div>

    <div class="container my-5">

        <div class="row gy-3">

            <div class="col-lg-6">

                <div class="row gy-3">
                    <div class="col-md-12">
                        <div class="info-box shadow">
                            <em class="bi bi-geo-alt"></em>
                            <h3>Unsere Adresse</h3>
                            <p>{{ env('TTF_STRASSE') . ', ' . env('TTF_ORT') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box shadow">
                            <em class="bi bi-envelope"></em>
                            <h3>Schreiben Sie uns eine E-Mail</h3>
                            <p>{{ env('TTF_EMAIL') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box shadow">
                            <em class="bi bi-telephone"></em>
                            <h3>Rufen Sie uns an</h3>
                            <p>{{ env('TTF_TELEFON') }}</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                <form action="{{ route('frontend.kontakt.store') }}" method="POST" role="form" class="php-email-form shadow" id="kontaktForm">
                    @csrf

                    <div class="row gy-3">
                        <div class="col-lg-6">
                            <label for="name" class="d-none"></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Dein Name" value="{{ old('name') }}">
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <label for="email" class="d-none"></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Deine E-Mail Adresse" value="{{ old('email') }}">
                            @error('email')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="subject" class="d-none"></label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Betreff" value="{{ old('subject') }}">
                            @error('subject')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="message" class="d-none"></label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" placeholder="Deine Nachricht" rows="5">{{ old('message') }}</textarea>
                            @error('message')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button class="btn btn-sm btn-primary text-black position-relative submit" onclick="this.classList.toggle('btn-loading')" type="submit">
                                <span class="btn-text">Nachricht senden</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>

    </div>
</section>

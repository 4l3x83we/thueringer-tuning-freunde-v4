@include('helpers.component.recaptcha')

<section class="kontakt" id="kontakt">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="section-title">
            <h2>Kontakt</h2>
        </div>

    </div>

    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2494.5373878205105!2d11.432863315977622!3d51.30123683357678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47a405bfa95dab67%3A0x95ced3453404d44a!2sTh%C3%BCringer%20Tuning%20Freunde!5e0!3m2!1sde!2sde!4v1666588386559!5m2!1sde!2sde" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <div class="container mb-5">

        <div class="row mt-5">

            <div class="col-lg-6">

                <div class="row">
                    <div class="col-md-12">
                        <div class="info-box shadow">
                            <em class="bi bi-geo-alt"></em>
                            <h3>Unsere Adresse</h3>
                            <p>{{ env('TTF_STRASSE') . ', ' . env('TTF_ORT') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box shadow mt-3">
                            <em class="bi bi-envelope"></em>
                            <h3>Schreiben Sie uns eine E-Mail</h3>
                            <p>{{ env('TTF_EMAIL') }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-box shadow mt-3">
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

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="d-none"></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Dein Name" value="{{ old('name') }}">
                            @error('name')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="d-none"></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Deine E-Mail Adresse" value="{{ old('email') }}">
                            @error('email')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
                            <label for="subject" class="d-none"></label>
                            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" placeholder="Betreff" value="{{ old('subject') }}">
                            @error('subject')
                            <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-lg-12 mb-3">
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

<section id="topbar">
    <div class="container-fluid d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
            <em class="bi bi-envelope-fill d-flex align-items-center"> <a href="mailto:{{ env('TTF_EMAIL') }}">{{ env('TTF_EMAIL') }}</a></em>
{{--            <em class="bi bi-telephone-fill d-flex align-items-center ms-4"> <a href="tel:{{ env('TTF_TELEFON') }}">{{ env('TTF_TELEFON') }}</a></em>--}}
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
            <a href="{{ env('TTF_FACEBOOK') }}" class="facebook" target="_blank"><em class="bi bi-facebook"></em></a>
            <a href="{{ env('TTF_INSTAGRAM') }}" class="instagram" target="_blank"><em class="bi bi-instagram"></em></a>
            <a href="{{ env('TTF_ANDROID') }}" class="android" target="_blank" download><em class="bi bi-android2"></em></a>
        </div>
    </div>
</section>

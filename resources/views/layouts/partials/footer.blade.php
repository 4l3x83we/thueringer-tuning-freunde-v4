<!-- ======= Footer ======= -->
<footer class="footer" id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-6 footer-info">
                    <h3>Über uns</h3>
                    <p>Dezent getunt oder voll aufgemotzt. … jeder fährt das, was sein Geldbeutel hergibt. Bei uns ist jeder willkommen, der am Tuning oder einfach nur Schrauben Spaß hat.</p>
                    <div class="social-links mt-3">
                        <a href="{{ env('TTF_FACEBOOK') }}" class="facebook" target="_blank"><em class="bi bi-facebook"></em></a>
                        <a href="{{ env('TTF_INSTAGRAM') }}" class="instagram" target="_blank"><em class="bi bi-instagram"></em></a>
                        <a href="{{ env('TTF_ANDROID') }}" class="android" target="_blank" download><em class="bi bi-android2"></em></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Nützliche Links</h4>
                    <ul>
                        <li><em class="bi bi-arrow-right-short"></em><a href="{{ route('frontend.index') }}">Home</a></li>
                        <li><em class="bi bi-arrow-right-short"></em><a href="#kontakt">Kontakt</a></li>
                        <li><em class="bi bi-arrow-right-short"></em><a href="{{ route('frontend.impressum') }}">Impressum / Disclaimer</a></li>
                        <li><em class="bi bi-arrow-right-short"></em><a href="{{ route('frontend.datenschutz') }}">Datenschutz-Bestimmungen</a></li>
                        <li><em class="bi bi-arrow-right-short"></em><a href="#" onclick="CCM.openWidget(); return false;">Cookie Einstellungen</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Unsere Vorteile</h4>
                    <ul>
                        <li><em class="bi bi-arrow-right-short"></em><span>Tuning</span></li>
                        <li><em class="bi bi-arrow-right-short"></em><span>Eigene Werkstatt</span></li>
                        <li><em class="bi bi-arrow-right-short"></em><span>Reifenservice</span></li>
                        <li><em class="bi bi-arrow-right-short"></em><span>Clubhaus</span></li>
                        <li><em class="bi bi-arrow-right-short"></em><span>Ersatzteile in kurzer Zeit</span></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-content">
                    <h4>Kontaktiere uns</h4>
                    <p>
                        {{ env('TTF_NAME') }}<br>
                        {{ env('TTF_STRASSE') }}<br>
                        {{ env('TTF_ORT') }}<br>
{{--                        <strong>Telefon: </strong><a href="tel:{{ env('TTF_TELEFON') }}">{{ env('TTF_TELEFON') }}</a><br>--}}
                        <strong>E-Mail: </strong><a href="mailto:{{ env('TTF_EMAIL') }}">{{ env('TTF_EMAIL') }}</a><br>
                    </p>
                </div>

            </div>
        </div>
    </div>

    <div class="container-xxl">
        <div class="copyright">
            &copy; Copyright <strong><span>{{ env('TTF_NAME') }}</span></strong>. Alle Rechte vorbehalten
        </div>
        <div class="credits">
            Designed by <a href="https://github.com/4l3x83we" target="_blank">4l3x83we</a> | <a href="{{ env('TTF_URL') }}">{{ env('TTF_URL') }}</a>
        </div>
    </div>
</footer>

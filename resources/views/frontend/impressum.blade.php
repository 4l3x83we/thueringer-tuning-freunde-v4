@extends('layouts.app')

@section('title', 'Impressum')
@section('description')
    {{ strip_tags(Str::limit('Wir sind ein kleiner Marken offener Tuning Club'), 150) }}
@endsection
@section('robots', 'INDEX,FOLLOW')

@section('content')
    <section id="impressum" class="container">

        <div class="row">
            <div class="col-lg-12">
                <h1>Impressum</h1>
                <h2 id="m46">Diensteanbieter</h2>
                <p class="mb-0 lead">{{ env('TTF_NAME') }}</p>
                <p class="mb-0 lead">{{ env('TTF_NAME1') }}</p>
                <p class="mb-0 lead">{{ env('TTF_STRASSE') }}</p>
                <p class="mb-0 lead">{{ env('TTF_ORT') }}</p>
                <p class="lead">Deutschland</p>
                <h2 id="m56">Kontaktmöglichkeiten</h2>
                <p class="mb-0 lead">E-Mail-Adresse: {{ env('TTF_EMAIL') }}</p>
                <p class="mb-0 lead">Telefon: {{ env('TTF_TELEFON') }}</p>
                <p class="lead">Fax: {{ env('TTF_FAX') }}</p>
                <p class="lead">Kontaktformular:<br> <em class="bi bi-envelope"></em> <a href="https://www.thueringer-tuning-freunde.de/kontakt" target="_blank">https://www.thueringer-tuning-freunde.de/kontakt</a></p>
                <h2 id="m172">Social Media und andere Onlinepräsenzen</h2>
                <p class="lead">Dieses Impressum gilt auch für die folgenden Social-Media-Präsenzen und Onlineprofile:</p>
                <p class="lead"><em class="bi bi-facebook"></em> <a href="https:{{ env('TTF_FACEBOOK') }}" target="_blank">https:{{ env('TTF_FACEBOOK') }}</a></p>
                <p class="lead"><em class="bi bi-instagram"></em> <a href="https:{{ env('TTF_INSTAGRAM') }}" target="_blank">https:{{ env('TTF_INSTAGRAM') }}</a></p>
                <h2 id="m65">Haftungs- und Schutzrechtshinweise</h2>
                <p class="lead"><strong class="fw-bold">Haftungsausschluss:</strong><br> Die Inhalte dieses Onlineangebotes wurden sorgfältig und nach unserem aktuellen Kenntnisstand erstellt, dienen jedoch nur der Information und entfalten keine rechtlich bindende Wirkung, sofern es sich nicht um gesetzlich verpflichtende Informationen (z.B. das Impressum, die Datenschutzerklärung, AGB oder verpflichtende Belehrungen von Verbrauchern) handelt. Wir behalten uns vor, die Inhalte vollständig oder teilweise zu ändern oder zu löschen, soweit vertragliche Verpflichtungen unberührt bleiben. Alle Angebote sind freibleibend und unverbindlich. </p>
                <p class="lead"><strong class="fw-bold">Links auf fremde Webseiten:</strong><br> Die Inhalte fremder Webseiten, auf die wir direkt oder indirekt verweisen, liegen außerhalb unseres Verantwortungsbereiches und wir machen sie uns nicht zu Eigen. Für alle Inhalte und Nachteile, die aus der Nutzung der in den verlinkten Webseiten aufrufbaren Informationen entstehen, übernehmen wir keine Verantwortung.</p>
                <p class="lead"><strong class="fw-bold">Urheberrechte und Markenrechte:</strong><br> Alle auf dieser Website dargestellten Inhalte, wie Texte, Fotografien, Grafiken, Marken und Warenzeichen sind durch die jeweiligen Schutzrechte (Urheberrechte, Markenrechte) geschützt. Die Verwendung, Vervielfältigung usw. unterliegen unseren Rechten oder den Rechten der jeweiligen Urheber bzw. Rechteinhaber.</p>
                <p class="lead"><strong class="fw-bold">Hinweise auf Rechtsverstöße:</strong><br> Sollten Sie innerhalb unseres Internetauftritts Rechtsverstöße bemerken, bitten wir Sie uns auf diese hinzuweisen. Wir werden rechtswidrige Inhalte und Links nach Kenntnisnahme unverzüglich entfernen.</p>
                {{--                <h2 id="m169">Bildnachweise</h2>--}}
                <p class="seal lead">
                    <a href="https://datenschutz-generator.de/" title="Rechtstext von Dr. Schwenke - für weitere Informationen bitte anklicken." target="_blank" rel="noopener noreferrer nofollow">Erstellt mit kostenlosem Datenschutz-Generator.de von Dr. Thomas Schwenke</a>
                </p>
            </div>
        </div>
    </section>
@endsection

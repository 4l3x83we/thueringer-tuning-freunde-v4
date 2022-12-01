<div class="header">
    <h1>Fahrzeugdaten</h1>
    <div class="form-check form-switch mb-0">
        <input type="checkbox" class="form-check-input" role="switch" id="fahrzeugvorhanden" name="fahrzeugvorhanden" data-toggle-fz="#showFahrzeugVorhanden" data-toggle-fb="#showFahrzeugBilder" @if(old('fahrzeugvorhanden')) checked @endif>
        <label for="fahrzeugvorhanden" class="form-check-label" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Nur auswählen wenn kein Fahrzeug vorhanden ist.">Kein Fahrzeug vorhanden
            <em class="bi bi-exclamation-triangle"></em></label>
    </div>
</div>
<div class="body">
    <div class="row" id="showFahrzeugVorhanden">
        <p class="trennung fw-bold lead">Solltest du mehrere Fahrzeuge besitzen, oder im Moment noch an einem Projekt arbeiten, so kannst du das nach erfolgreicher Annahme ganz einfach über dein Menü hinzufügen?</p>
        <div class="col-lg-6 mb-3">
            <label for="fahrzeug" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Fahrzeug:<small class="position-relative">*</small></label>
            <input type="text" name="fahrzeug" id="fahrzeug" class="form-control form-control-sm @error('fahrzeug') is-invalid @enderror" value="{{ old('fahrzeug') }} @isset($fahrzeuge) {{ $fahrzeuge->fahrzeug }} @endisset" maxlength="255">
            @error('fahrzeug')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <label for="baujahr" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Baujahr:<small class="position-relative">*</small></label>
            <input type="text" name="baujahr" id="baujahr" class="form-control form-control-sm @error('baujahr') is-invalid @enderror" value="{{ old('baujahr') }} @isset($fahrzeuge) {{ $fahrzeuge->baujahr }} @endisset" maxlength="4">
            @error('baujahr')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-12 mb-3">
            <small><span class="text-danger">Tipp:</span> unten <u class="text-success">rechts</u> auf Wörter klicken und es werden dir deine eingegebenen Zeichen angezeigt.</small>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="besonderheiten" class="form-label">Besonderheiten:</label>
            <textarea name="besonderheiten" id="besonderheiten" class="form-control form-control-sm @error('besonderheiten') is-invalid @enderror">{{ old('besonderheiten') }} @isset($fahrzeuge) {{ $fahrzeuge->besonderheiten }} @endisset</textarea>
            @error('besonderheiten')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            @error('motor')
            <label for="motor" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Motor:<small class="position-relative">*</small> <span class="form-text text-danger">{{ $message }}</span></label>
            @else
                <label for="motor" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Motor:<small class="position-relative">*</small></label>
                @enderror
                <textarea name="motor" id="motor" class="form-control form-control-sm @error('motor') is-invalid @enderror">{{ old('motor') }} @isset($fahrzeuge) {{ $fahrzeuge->motor }} @endisset</textarea>
        </div>
        <div class="col-lg-6 mb-3">
            <label for="karosserie" class="form-label">Karosserie:</label>
            <textarea name="karosserie" id="karosserie" class="form-control form-control-sm @error('karosserie') is-invalid @enderror">{{ old('karosserie') }} @isset($fahrzeuge) {{ $fahrzeuge->karosserie }} @endisset</textarea>
            @error('karosserie')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <label for="felgen" class="form-label">Felgen:</label>
            <textarea name="felgen" id="felgen" class="form-control form-control-sm @error('felgen') is-invalid @enderror">{{ old('felgen') }} @isset($fahrzeuge) {{ $fahrzeuge->felgen }} @endisset</textarea>
            @error('felgen')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <label for="fahrwerk" class="form-label">Fahrwerk:</label>
            <textarea name="fahrwerk" id="fahrwerk" class="form-control form-control-sm @error('fahrwerk') is-invalid @enderror">{{ old('fahrwerk') }} @isset($fahrzeuge) {{ $fahrzeuge->fahrwerk }} @endisset</textarea>
            @error('fahrwerk')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <label for="bremsen" class="form-label">Bremsen:</label>
            <textarea name="bremsen" id="bremsen" class="form-control form-control-sm @error('bremsen') is-invalid @enderror">{{ old('bremsen') }} @isset($fahrzeuge) {{ $fahrzeuge->bremsen }} @endisset</textarea>
            @error('bremsen')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <label for="innenraum" class="form-label">Innenraum:</label>
            <textarea name="innenraum" id="innenraum" class="form-control form-control-sm @error('innenraum') is-invalid @enderror">{{ old('innenraum') }} @isset($fahrzeuge) {{ $fahrzeuge->innenraum }} @endisset</textarea>
            @error('innenraum')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <label for="anlage" class="form-label">Anlage:</label>
            <textarea name="anlage" id="anlage" class="form-control form-control-sm @error('anlage') is-invalid @enderror" placeholder="test">{{ old('anlage') }} @isset($fahrzeuge) {{ $fahrzeuge->anlage }} @endisset</textarea>
            @error('anlage')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-12 mb-3">
            @error('beschreibungFz')
            <label for="beschreibungFz" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small> <span class="form-text text-danger">{{ $message }}</span></label>
            @else
                <label for="beschreibungFz" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small> <span>(mindestens 25 Zeichen)</span></label>
                @enderror
                <textarea name="beschreibungFz" id="beschreibungFz" class="form-control form-control-sm @error('beschreibungFz') is-invalid @enderror">{{ old('beschreibungFz') }} @isset($fahrzeuge) {{ $fahrzeuge->description }} @endisset</textarea>
        </div>
    </div>
</div>

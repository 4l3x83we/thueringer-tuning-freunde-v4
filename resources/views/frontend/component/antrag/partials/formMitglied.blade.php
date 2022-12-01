<div class="header">
    <h1>Antragsteller</h1>
    <small>* Pflichtfeld</small>
</div>
<div class="body">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <label for="anrede" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Anrede:<small class="position-relative">*</small></label>
            <select name="anrede" id="anrede" class="form-select form-select-sm @error('anrede') is-invalid @enderror">
                <option value="">-- bitte wählen --</option>
                <option value="Herr" {{ ( old('anrede') ?: (isset($team) && $team->anrede === 'Herr')) ? 'selected' : '' }}>Herr</option>
                <option value="Frau" {{ ( old('anrede') ?: (isset($team) && $team->anrede === 'Frau')) ? 'selected' : '' }}>Frau</option>
                <option value="Divers" {{ ( old('anrede') ?: (isset($team) && $team->anrede === 'Divers')) ? 'selected' : '' }}>Divers</option>
                <option value="keine Angabe" {{ ( old('anrede') ?: (isset($team) && $team->anrede === 'keine Angabe')) ? 'selected' : '' }}>keine Angabe</option>
            </select>
            @error('anrede')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="vorname" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Vorname:<small class="position-relative">*</small></label>
            <input type="text" name="vorname" id="vorname" class="form-control form-control-sm @error('vorname') is-invalid @enderror" value="{{ old('vorname') }} @isset($team) {{ $team->vorname }} @endisset" maxlength="255">
            @error('vorname')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="nachname" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Nachname:<small class="position-relative">*</small></label>
            <input type="text" name="nachname" id="nachname" class="form-control form-control-sm @error('nachname') is-invalid @enderror" value="{{ old('nachname') }} @isset($team) {{ $team->nachname }} @endisset" maxlength="255">
            @error('nachname')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="straße" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Straße:<small class="position-relative">*</small></label>
            <input type="text" name="straße" id="straße" class="form-control form-control-sm @error('straße') is-invalid @enderror" value="{{ old('straße') }} @isset($team) {{ $team->straße }} @endisset" maxlength="255">
            @error('straße')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-2 mb-3">
            <label for="plz" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Postleitzahl:<small class="position-relative">*</small></label>
            <input type="text" name="plz" id="plz" class="form-control form-control-sm @error('plz') is-invalid @enderror" value="{{ old('plz') }} @isset($team) {{ $team->plz }} @endisset" maxlength="5" pattern="[0-9]+">
            @error('plz')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-6 mb-3">
            <label for="ort" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Wohnort:<small class="position-relative">*</small></label>
            <input type="text" name="ort" id="ort" class="form-control form-control-sm @error('ort') is-invalid @enderror" value="{{ old('ort') }} @isset($team) {{ $team->ort }} @endisset" maxlength="255">
            @error('ort')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

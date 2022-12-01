<div class="header">
    <h1>Über mich</h1>
</div>
<div class="body">
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="profilbild" class="form-label">Profilbild:@error('profilbild') <span class="form-text text-danger">{{ $message }}</span> @enderror</label>
            <input type="file" name="profilbild" id="profilbild" class="form-control form-control-sm @error('profilbild') is-invalid @enderror" value="{{ old('profilbild') }}">
        </div>
        <div class="col-lg-12 mb-3">
            @error('description')
                <label for="description" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small> @error('description') <span class="form-text text-danger">{{ $message }}</span> @enderror</label>
            @else
                <label for="description" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small> <span>(mindestens 250 Zeichen)</span></label>
            @enderror
                <textarea name="description" id="description" class="form-control form-control-sm @error('description') is-invalid @enderror">{!! old('description') !!} @isset($team) {{ $team->description }} @endisset</textarea>
        </div>
    </div>
</div>

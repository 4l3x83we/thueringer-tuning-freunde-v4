<div class="row g-3">
    <div class="col-lg-4">
        <label for="inputTitle" class="form-label fw-bold">Titel:</label>
        <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" id="inputTitle" name="title" placeholder="Titel" value="{{ old('title') ?: $galerie->title }}" maxlength="255">
        @error('title')
            <span class="form-text text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-lg-3">
        <label for="selectKategorie" class="form-label fw-bold">Kategorie:</label>
        <select class="form-select form-select-sm @error('kategorie') is-invalid @enderror" id="selectKategorie" name="kategorie" placeholder="Kategorie" value="{{ $galerie->kategorie }}">
            <option {{ old('kategorie', $galerie->kategorie) === 'Fahrzeuge' ? 'selected' : '' }} value="Fahrzeuge">Fahrzeuge</option>
            <option {{ old('kategorie', $galerie->kategorie) === 'Projekte' ? 'selected' : '' }} value="Projekte">Projekte</option>
            <option {{ old('kategorie', $galerie->kategorie) === 'Treffen' ? 'selected' : '' }} value="Treffen">Treffen</option>
            <option {{ old('kategorie', $galerie->kategorie) === 'Club-interne-Treffen' ? 'selected' : '' }} value="Club-interne-Treffen">Club interne Treffen</option>
        </select>
        @error('kategorie')
            <span class="form-text text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-lg-3">
        <label for="published_at" class="form-label fw-bold">Veröffentlicht am: <em class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hier kannst du auch ein Datum angeben, ab wann das Album veröffentlicht werden soll."></em></label>
        <input type="datetime-local" class="form-control form-control-sm @error('published_at') is-invalid @enderror" id="published_at" name="published_at" placeholder="Veröffentlicht" value="{{ old('published_at') ?: \Carbon\Carbon::parse($galerie->published_at)->format('Y-m-d\TH:i') }}">
        @error('published_at')
        <span class="form-text text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-lg-2">
        <label for="publish" class="form-label fw-bold">&nbsp;</label>
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published" value="{{ old('published') ?: 1 }}" {{ old('published', $galerie->published) ? 'checked' : '' }}>
            <label for="published" class="form-check-label">Veröffentlicht</label>
        </div>
        @error('published')
        <span class="form-text text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-lg-12">
        <label for="description" class="form-label fw-bold">Beschreibung:</label>
        <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" name="description" placeholder="Hier kannst du eine Beschreibung zu deinem Album hinzufügen.">{{ old('description') ?: $galerie->description }}</textarea>
        @error('description')
        <span class="form-text text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="col-lg-12">
        <label for="images1" class="form-label fw-bold">Bilder hinzufügen:</label>
        <input type="file" class="file form-control form-control-sm @error('images') is-invalid @enderror" id="images1" name="images[]" data-browse-on-zone-click="true" data-msg-placeholder="Wählen Sie {files} zum Hochladen aus ..." multiple>
        @error('images')
        <span class="form-text text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>

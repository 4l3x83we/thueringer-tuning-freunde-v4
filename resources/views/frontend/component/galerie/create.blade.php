<!-- Modal -->
<div class="modal fade" id="createAlbumModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="createAlbumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('frontend.galerie.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createAlbumModalLabel">Neues Album anlegen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <label for="inputTitle" class="form-label fw-bold">Titel:</label>
                            <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" id="inputTitle" name="title" placeholder="Titel" value="{{ old('title') }}" maxlength="255">
                            @error('title')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="selectKategorie" class="form-label fw-bold">Kategorie:</label>
                            <select class="form-select form-select-sm @error('kategorie') is-invalid @enderror" id="selectKategorie" name="kategorie">
                                <option {{ old('kategorie') === 'Treffen' ? 'selected' : '' }} value="Treffen">Treffen</option>
                                <option {{ old('kategorie') === 'Club interne Treffen' ? 'selected' : '' }} value="Club interne Treffen">Club interne Treffen</option>
                            </select>
                            @error('kategorie')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <label for="published_at" class="form-label fw-bold">Veröffentlicht am: <em class="bi bi-question-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hier kannst du auch ein Datum angeben, ab wann das Album veröffentlicht werden soll."></em></label>
                            <input type="datetime-local" class="form-control form-control-sm @error('published_at') is-invalid @enderror" id="published_at" name="published_at" placeholder="Veröffentlicht" value="{{ old('published_at') }}">
                            @error('published_at')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-2">
                            <label for="publish" class="form-label fw-bold">&nbsp;</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input @error('published') is-invalid @enderror" id="published" name="published" value="{{ old('published') ?: 1 }}">
                                <label for="published" class="form-check-label">Veröffentlicht</label>
                            </div>
                            @error('published')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="description" class="form-label fw-bold">Beschreibung:</label>
                            <textarea class="form-control form-control-sm @error('description') is-invalid @enderror" id="description" name="description" placeholder="Hier kannst du eine Beschreibung zu deinem Album hinzufügen.">{{ old('description') }}</textarea>
                            @error('description')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="images" class="form-label fw-bold">Bilder hinzufügen:</label>
                            <input type="file" class="form-control form-control-sm @error('images') is-invalid @enderror" id="images" name="images[]" data-browse-on-zone-click="true" data-msg-placeholder="Wählen Sie {files} zum Hochladen aus ..." multiple>
                            @error('images')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>

@csrf
    <input type="hidden" name="album_id" value="{{ $galerie->id }}">
    <label for="images" class="form-label fw-bold">Bilder hinzufügen:</label>
    <input type="file" class="file form-control form-control-sm @error('images') is-invalid @enderror" id="images" name="images[]" data-browse-on-zone-click="true" data-msg-placeholder="Wählen Sie {files} zum Hochladen aus ..." multiple>
@error('images')
    <span class="form-text text-danger">{{ $message }}</span>
@enderror

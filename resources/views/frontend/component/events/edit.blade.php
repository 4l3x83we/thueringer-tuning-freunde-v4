<!-- Modal -->
<div class="modal fade" id="editVeranstaltungModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editVeranstaltungModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('frontend.veranstaltungen.update', $veranstaltungen->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editAlbumModalLabel">Neue Veranstaltung anlegen</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-2">
                            <label for="von" class="form-label fw-bold">Datum von:</label>
                            <input type="datetime-local" class="form-control form-control-sm @error('von') is-invalid @enderror" id="von" name="von" placeholder="Datum von" value="{{ old('von') ?: $veranstaltungen->datum_von }}">
                            @error('von')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-2">
                            <label for="bis" class="form-label fw-bold">Datum bis:</label>
                            <input type="datetime-local" class="form-control form-control-sm @error('bis') is-invalid @enderror" id="bis" name="bis" placeholder="Datum bis" value="{{ old('bis') ?: $veranstaltungen->datum_bis }}">
                            @error('bis')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="veranstaltung" class="form-label fw-bold">Veranstaltung:</label>
                            <input type="text" class="form-control form-control-sm @error('veranstaltung') is-invalid @enderror" id="veranstaltung" name="veranstaltung" placeholder="Veranstaltung" value="{{ old('veranstaltung') ?: $veranstaltungen->veranstaltung }}">
                            @error('veranstaltung')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="veranstaltungsort" class="form-label fw-bold">Veranstaltungsort:</label>
                            <input type="text" class="form-control form-control-sm @error('veranstaltungsort') is-invalid @enderror" id="veranstaltungsort" name="veranstaltungsort" placeholder="Veranstaltungsort" value="{{ old('veranstaltungsort') ?: $veranstaltungen->veranstaltungsort }}">
                            @error('veranstaltungsort')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="veranstalter" class="form-label fw-bold">Veranstalter:</label>
                            <input type="text" class="form-control form-control-sm @error('veranstalter') is-invalid @enderror" id="veranstalter" name="veranstalter" placeholder="Veranstalter" value="{{ old('veranstalter') ?: $veranstaltungen->veranstalter }}">
                            @error('veranstalter')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="quelle" class="form-label fw-bold">Quelleangabe: </label>
                            <input type="text" class="form-control form-control-sm @error('quelle') is-invalid @enderror" id="quelle" name="quelle" placeholder="Quelleangabe zum Event" value="{{ old('quelle') ?: $veranstaltungen->quelle }}">
                            @error('quelle')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <label for="eintritt" class="form-label">Eintritt:</label>
                            <input type="text" class="form-control form-control-sm @error('eintritt') is-invalid @enderror" id="eintritt" name="eintritt" placeholder="Eintritt" value="{{ old('eintritt') ?: $veranstaltungen->eintritt }}">
                            @error('eintritt')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="beschreibung" class="form-label fw-bold">Beschreibung:</label>
                            <textarea class="form-control form-control-sm @error('beschreibung') is-invalid @enderror" id="beschreibung" name="beschreibung" placeholder="Hier kannst du eine Beschreibung zu deiner Veranstaltung hinzufügen.">{{ old('beschreibung') ?: $veranstaltungen->description }}</textarea>
                            @error('beschreibung')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary">Veranstaltung speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>

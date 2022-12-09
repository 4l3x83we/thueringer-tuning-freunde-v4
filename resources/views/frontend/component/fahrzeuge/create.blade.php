<!-- Modal -->
<div class="fahrzeuge">
    <div class="modal fade" id="fahrzeugeCreateModal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="fahrzeugeCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="{{ route('frontend.fahrzeuge.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="fahrzeugeCreateModalLabel">Neues Fahrzeug anlegen.</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('helpers.component.recaptcha')
                        @csrf
                        <div class="row mx-3">
                            <div class="col-lg-12 text-bg-dark shadow mt-4 fahrzeugeCreate" data-aos="fade-up" data-aos-delay="100">
                                <div class="header">
                                    <h1>Fahrzeugdaten</h1>
                                </div>
                                <div class="body">
                                    <div class="row" id="showFahrzeugVorhanden">
                                        <p class="trennung fw-bold lead">Solltest du mehrere Fahrzeuge besitzen, oder im Moment noch an einem Projekt arbeiten, so kannst du das nach erfolgreicher Annahme ganz einfach über dein Menü hinzufügen?</p>
                                        <div class="col-lg-4 col-md-12 mb-3">
                                            @error('beschreibungFz')
                                            <label for="kategorie" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgewählt werden.">Kategorie:<small class="position-relative">*</small></label>
                                            @else
                                                <label for="kategorie" class="form-label fw-bold">Kategorie:<small class="position-relative">*</small></label>
                                            @enderror
                                            <select name="kategorie" id="kategorie" class="form-select form-select-sm @error('anlage') {{ 'Du musst eine Kategorie auswählen.' }} is-invalid @enderror">
                                                <option value="" selected>-- Kategorie wählen --</option>
                                                <option value="Fahrzeuge" {{ old('kategorie') === 'Fahrzeuge' ? 'selected=selected' : '' }}>Fahrzeuge</option>
                                                <option value="Projekte" {{ old('kategorie') === 'Projekte' ? 'selected=selected' : '' }}>Projekte</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-6 mb-3">
                                            <label for="fahrzeug" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Fahrzeug:<small class="position-relative">*</small></label>
                                            <input type="text" name="fahrzeug" id="fahrzeug" class="form-control form-control-sm @error('fahrzeug') is-invalid @enderror" value="{{ old('fahrzeug') }}" maxlength="255" placeholder="Fahrzeug">
                                            @error('fahrzeug')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 col-md-6 mb-3">
                                            <label for="baujahr" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Baujahr:<small class="position-relative">*</small></label>
                                            <input type="text" name="baujahr" id="baujahr" class="form-control form-control-sm @error('baujahr') is-invalid @enderror" value="{{ old('baujahr') }}" maxlength="4">
                                            @error('baujahr')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <small><span class="text-danger">Tipp:</span> unten <u class="text-success">rechts</u> auf Wörter klicken und es werden dir deine eingegebenen Zeichen angezeigt.</small>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="besonderheiten" class="form-label">Besonderheiten:</label>
                                            <textarea name="besonderheiten" id="besonderheiten" class="form-control form-control-sm @error('besonderheiten') is-invalid @enderror" placeholder="Besonderheiten">{!! old('besonderheiten') !!}</textarea>
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
                                                <textarea name="motor" id="motor" class="form-control form-control-sm @error('motor') is-invalid @enderror" placeholder="Motor">{{ old('motor') }}</textarea>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="karosserie" class="form-label">Karosserie:</label>
                                            <textarea name="karosserie" id="karosserie" class="form-control form-control-sm @error('karosserie') is-invalid @enderror" placeholder="Karosserie">{{ old('karosserie') }}</textarea>
                                            @error('karosserie')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="felgen" class="form-label">Felgen:</label>
                                            <textarea name="felgen" id="felgen" class="form-control form-control-sm @error('felgen') is-invalid @enderror" placeholder="Felgen">{{ old('felgen') }}</textarea>
                                            @error('felgen')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="fahrwerk" class="form-label">Fahrwerk:</label>
                                            <textarea name="fahrwerk" id="fahrwerk" class="form-control form-control-sm @error('fahrwerk') is-invalid @enderror" placeholder="Fahrwerk">{{ old('fahrwerk') }}</textarea>
                                            @error('fahrwerk')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="bremsen" class="form-label">Bremsen:</label>
                                            <textarea name="bremsen" id="bremsen" class="form-control form-control-sm @error('bremsen') is-invalid @enderror" placeholder="Bremsen">{{ old('bremsen') }}</textarea>
                                            @error('bremsen')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="innenraum" class="form-label">Innenraum:</label>
                                            <textarea name="innenraum" id="innenraum" class="form-control form-control-sm @error('innenraum') is-invalid @enderror" placeholder="Innenraum">{{ old('innenraum') }}</textarea>
                                            @error('innenraum')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="anlage" class="form-label">Anlage:</label>
                                            <textarea name="anlage" id="anlage" class="form-control form-control-sm @error('anlage') is-invalid @enderror" placeholder="Anlage">{{ old('anlage') }}</textarea>
                                            @error('anlage')
                                            <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            @error('beschreibungFz')
                                            <label for="beschreibungFz" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small>
                                                <span class="form-text text-danger">{{ $message }}</span></label>
                                            @else
                                                <label for="beschreibungFz" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small>
                                                    <span>(mindestens 25 Zeichen)</span></label>
                                                @enderror
                                                <textarea name="beschreibungFz" id="beschreibungFz" placeholder="Hier kannst du dein Fahrzeug beschreiben." class="form-control form-control-sm @error('beschreibungFz') is-invalid @enderror">{{ old('beschreibungFz') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 text-bg-dark shadow mt-4 fahrzeugeCreate" data-aos="fade-up" data-aos-delay="100" id="showFahrzeugBilder">
                                <div class="header">
                                    <h1>Fahrzeugbilder</h1>
                                </div>
                                <div class="body">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <label for="images1" class="form-label">Fahrzeugbilder: <small class="text-muted">(maximal 10 Bilder gleichzeitig bei insgesamt 10 MB)</small></label>
                                            <input type="file" id="images1" class="file" name="images[]" data-overwrite-initial="false" data-browse-on-zone-click="true" data-msg-placeholder="Wählen Sie {files} zum Hochladen aus ..." multiple accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schliessen</button>
                        <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

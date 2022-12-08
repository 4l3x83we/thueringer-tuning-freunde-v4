@include('helpers.component.recaptcha')
@csrf
@method('PATCH')
<input type="hidden" name="user_id" value="{{ $team->user_id }}">
<div class="row mx-3">
    <div class="col-lg-12 shadow teamEdit" data-aos="fade-up" data-aos-delay="100">
        <div class="header">
            <h5>Antragsteller</h5>
            <small>* Pflichtfeld</small>
        </div>
        <div class="body">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <label for="anrede" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Anrede:<small class="position-relative">*</small></label>
                    <select name="anrede" id="anrede" class="form-select form-select-sm @error('anrede') is-invalid @enderror">
                        <option value="Herr" @if($team->anrede === 'Herr') {{ 'selected=selected' }} @endif>Herr</option>
                        <option value="Frau" @if($team->anrede === 'Frau') {{ 'selected=selected' }} @endif>Frau</option>
                        <option value="Divers" @if($team->anrede === 'Divers') {{ 'selected=selected' }} @endif>Divers</option>
                        <option value="keine Angabe" @if($team->anrede === 'keine Angabe') {{ 'selected=selected' }} @endif>keine Angabe</option>
                    </select>
                    @error('anrede')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="vorname" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Vorname:<small class="position-relative">*</small></label>
                    <input type="text" name="vorname" id="vorname" class="form-control form-control-sm @error('vorname') is-invalid @enderror" value="{{ $team->vorname }}" maxlength="255">
                    @error('vorname')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="nachname" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Nachname:<small class="position-relative">*</small></label>
                    <input type="text" name="nachname" id="nachname" class="form-control form-control-sm @error('nachname') is-invalid @enderror" value="{{ $team->nachname }}" maxlength="255">
                    @error('nachname')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="straße" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Straße:<small class="position-relative">*</small></label>
                    <input type="text" name="straße" id="straße" class="form-control form-control-sm @error('straße') is-invalid @enderror" value="{{ $team->straße }}" maxlength="255">
                    @error('straße')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-2 mb-3">
                    <label for="plz" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Postleitzahl:<small class="position-relative">*</small></label>
                    <input type="text" name="plz" id="plz" class="form-control form-control-sm @error('plz') is-invalid @enderror" value="{{ $team->plz }}" maxlength="5" pattern="[0-9]+">
                    @error('plz')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="ort" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Wohnort:<small class="position-relative">*</small></label>
                    <input type="text" name="ort" id="ort" class="form-control form-control-sm @error('ort') is-invalid @enderror" value="{{ $team->wohnort }}" maxlength="255">
                    @error('ort')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 shadow mt-4 teamEdit" data-aos="fade-up" data-aos-delay="100">
        <div class="header">
            <h5>Kontaktdaten</h5>
        </div>
        <div class="body">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <label for="telefon" class="form-label">Telefon:</label>
                    <input type="tel" name="telefon" id="telefon" class="form-control form-control-sm @error('telefon') is-invalid @enderror" value="{{ $team->telefon }}" maxlength="15">
                    @error('telefon')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="mobil" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Mobilfunk:<small class="position-relative">*</small></label>
                    <input type="tel" name="mobil" id="mobil" class="form-control form-control-sm @error('mobil') is-invalid @enderror" value="{{ $team->mobil }}" maxlength="15">
                    @error('mobil')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="email" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">E-Mail Adresse:<small class="position-relative">*</small></label>
                    <input type="email" name="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ $team->email }}" maxlength="255">
                    @error('email')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="geburtsdatum" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Geburtsdatum:<small class="position-relative">*</small></label>
                    <input type="date" name="geburtsdatum" id="geburtsdatum" class="form-control form-control-sm @error('geburtsdatum') is-invalid @enderror" value="{{ old('geburtsdatum') ?: \Carbon\Carbon::parse($team->geburtsdatum)->format('Y-m-d') }}" maxlength="10">
                    @error('geburtsdatum')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="beruf" class="form-label">Beruf:</label>
                    <input type="text" name="beruf" id="beruf" class="form-control form-control-sm @error('beruf') is-invalid @enderror" value="{{ $team->beruf }}" maxlength="255">
                    @error('beruf')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3"></div>
                <div class="col-lg-4 mb-3">
                    <label for="facebook" class="form-label">Facebook: <a href="https://www.facebook.com/settings?tab=account" target="_blank"><em class="bi bi-question"></em><small>Hilfe</small></a></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text" id="facebookLink">https://www.facebook.com/</span>
                        <input type="text" name="facebook" id="facebook" class="form-control form-control-sm @error('facebook') is-invalid @enderror" value="{{ $team->facebook }}" maxlength="255" aria-describedby="facebookLink">
                    </div>
                    @error('facebook')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="tiktok" class="form-label">TikTok: </label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text" id="tiktokLink">https://www.tiktok.com/</span>
                        <input type="text" name="tiktok" id="tiktok" class="form-control form-control-sm @error('tiktok') is-invalid @enderror" value="{{ $team->tiktok }}" maxlength="255" placeholder="@deinBenutzername" aria-describedby="tiktokLink">
                    </div>
                    @error('tiktok')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 mb-3">
                    <label for="instagram" class="form-label">Instagram: <a href="https://www.instagram.com/accounts/edit/" target="_blank"><em class="bi bi-question"></em><small>Hilfe</small></a></label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text" id="instagramLink">https://www.instagram.com/</span>
                        <input type="text" name="instagram" id="instagram" class="form-control form-control-sm @error('instagram') is-invalid @enderror" value="{{ $team->instagram }}" maxlength="255" aria-describedby="instagramLink">
                        <span class="input-group-text" id="instagramLink">/</span>
                    </div>
                    @error('instagram')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 shadow mt-4 teamEdit" data-aos="fade-up" data-aos-delay="100">
        <div class="header">
            <h5>Über mich</h5>
        </div>
        <div class="body">
            <div class="row">
                @if($team->photo_id)
                    <div class="col-lg-12 mb-3">
                        <img src="{{ asset('images/default.png') }}" data-src="{{ URL::asset($team->path.'/'.\App\Models\Frontend\Album\Photo::where('team_id', $team->id)->first()->images) }}" alt="{{ $team->title }}" class="img-fluid img-thumbnail lozad" style="width: 306px; object-fit: cover; object-position: 50% 50%;">
                    </div>
                @else
                    <div class="col-lg-12 mb-3">
                        <span class="text-danger fw-bold">Du hast noch kein Profilbild hochgeladen.</span>
                    </div>
                @endif
                <div class="col-lg-12 mb-3">
                    <label for="profilbild" class="form-label">Profilbild:@error('profilbild') <span class="form-text text-danger">{{ $message }}</span> @enderror</label>
                    <input type="file" name="profilbild" id="profilbild" class="form-control form-control-sm @error('profilbild') is-invalid @enderror" accept="image/gif, image/jpg, image/jpeg, image/png, image/tif, image/tiff, image/svg">
                </div>
                <div class="col-lg-12 mb-3">
                    @error('description')
                        <label for="description" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small> @error('description') <span class="form-text text-danger">{{ $message }}</span> @enderror</label>
                    @else
                        <label for="description" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Beschreibung:<small class="position-relative">*</small> <span>(mindestens 250 Zeichen)</span></label>
                    @enderror
                        <textarea name="description" id="description" class="form-control form-control-sm @error('description') is-invalid @enderror">{!! old('description') ?: $team->description !!}</textarea>
                </div>
            </div>
        </div>
    </div>
</div>

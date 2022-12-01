<div class="header">
    <h1>Kontaktdaten</h1>
</div>
<div class="body">
    <div class="row">
        <div class="col-lg-4 mb-3">
            <label for="telefon" class="form-label">Telefon:</label>
            <input type="tel" name="telefon" id="telefon" class="form-control form-control-sm @error('telefon') is-invalid @enderror" value="{{ old('telefon') }} @isset($team) {{ $team->telefon }} @endisset" maxlength="15">
            @error('telefon')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="mobil" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Mobilfunk:<small class="position-relative">*</small></label>
            <input type="tel" name="mobil" id="mobil" class="form-control form-control-sm @error('mobil') is-invalid @enderror" value="{{ old('mobil') }} @isset($team) {{ $team->mobil }} @endisset" maxlength="15">
            @error('mobil')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="email" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">E-Mail Adresse:<small class="position-relative">*</small></label>
            <input type="email" name="email" id="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }} @isset($team) {{ $team->email }} @endisset" maxlength="255">
            @error('email')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="geburtsdatum" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Geburtsdatum:<small class="position-relative">*</small></label>
            <input type="date" name="geburtsdatum" id="geburtsdatum" class="form-control form-control-sm @error('geburtsdatum') is-invalid @enderror" value="@isset($team) {{ \Carbon\Carbon::parse($team->geburtsdatum)->format('d-m-Y') }} @endisset" maxlength="10">
            @error('geburtsdatum')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="beruf" class="form-label">Beruf:</label>
            <input type="text" name="beruf" id="beruf" class="form-control form-control-sm @error('beruf') is-invalid @enderror" value="{{ old('beruf') }}" maxlength="255">
            @error('beruf')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3"></div>
        <div class="col-lg-4 mb-3">
            <label for="facebook" class="form-label">Facebook: <a href="https://www.facebook.com/settings?tab=account" target="_blank"><em class="bi bi-question"></em><small>Hilfe</small></a></label>
            <div class="input-group input-group-sm">
                <span class="input-group-text" id="facebookLink">https://www.facebook.com/</span>
                <input type="text" name="facebook" id="facebook" class="form-control form-control-sm @error('facebook') is-invalid @enderror" value="{{ old('facebook') }} @isset($team) {{ $team->facebook }} @endisset" maxlength="255" aria-describedby="facebookLink">
            </div>
            @error('facebook')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="twitter" class="form-label">Twitter: </label>
            <div class="input-group input-group-sm">
                <span class="input-group-text" id="twitterLink">https://www.twitter.com/</span>
                <input type="text" name="twitter" id="twitter" class="form-control form-control-sm @error('twitter') is-invalid @enderror" value="{{ old('twitter') }} @isset($team) {{ $team->twitter }} @endisset" maxlength="255" placeholder="@deinBenutzername" aria-describedby="twitterLink">
            </div>
            @error('twitter')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-lg-4 mb-3">
            <label for="instagram" class="form-label">Instagram: <a href="https://www.instagram.com/accounts/edit/" target="_blank"><em class="bi bi-question"></em><small>Hilfe</small></a></label>
            <div class="input-group input-group-sm">
                <span class="input-group-text" id="instagramLink">https://www.instagram.com/</span>
                <input type="text" name="instagram" id="instagram" class="form-control form-control-sm @error('instagram') is-invalid @enderror" value="{{ old('instagram') }} @isset($team) {{ $team->instagram }} @endisset" maxlength="255" aria-describedby="instagramLink">
                <span class="input-group-text" id="instagramLink">/</span>
            </div>
            @error('instagram')
            <span class="form-text text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>

<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="pw-tab">
    <form action="{{ route('intern.dashboard.update-password') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="header" style="border-radius: 0 10px 0 0;">
            <h5>Passwort ändern</h5>
        </div>
        <div class="body">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <label for="old_password" class="form-label fw-bold">Altes Passwort:</label>
                    <input type="password" name="old_password" id="old_password" class="form-control form-control-sm @error('old_password') is-invalid @enderror" placeholder="Altes Passwort" maxlength="255">
                    @error('old_password')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-12 mb-3">
                    <label for="new_password" class="form-label fw-bold">Neues Passwort:</label>
                    <input type="password" name="new_password" id="new_password" class="form-control form-control-sm @error('new_password') is-invalid @enderror" placeholder="Neues Passwort" maxlength="255">
                    @error('new_password')
                    <span class="form-text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-12 mb-3">
                    <label for="new_password_confirmation" class="form-label fw-bold">Bestätige neues Passwort:</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control form-control-sm" placeholder="Bestätige neues Passwort" maxlength="255">
                </div>
            </div>
        </div>

        <div class="body">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary">Passwort ändern</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@extends('layouts.auth')

@section('title', 'Anmelden')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            <div class="card mb-3 shadow">
                <div class="card-body">
                    <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">{{ __('Erstelle dein Passwort') }}</h5>
                        <p class="text-center small">{{ __('Hier kannst du dein Passwort festlegen') }}.</p>
                    </div>
                    <form method="POST" class="row g-3 needs-validation">
                        @csrf

                        <input type="hidden" name="email" value="{{ $user->email }}"/>
                        <div class="col-12">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <div class="input-group has-validation">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                            <div class="input-group has-validation">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">
                                {{ __('Save password and login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

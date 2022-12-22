@extends('layouts.app')

@section('title') Kalendereintrag bearbeiten @endsection
@section('description')
    {{ strip_tags(Str::limit('Hier kannst du deinen Termin bearbeiten.'), 150) }}
@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="calendar" id="calendar">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <form action="{{ route('intern.kalender.update-termin', $kalender->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label for="von" class="form-label">Datum + Zeit von:</label>
                        <input type="datetime-local" class="form-control @error('von') is-invalid @enderror" name="von" id="von" value="{{ old('von', $kalender->von) ?: \Carbon\Carbon::parse($kalender->von)->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="bis" class="form-label">Datum + Zeit bis:</label>
                        <input type="datetime-local" class="form-control @error('bis') is-invalid @enderror" name="bis" id="bis" value="{{ old('bis', $kalender->bis) ?: \Carbon\Carbon::parse($kalender->bis)->format('Y-m-d\TH:i') }}">
                    </div>
                    <div class="col-md-12">
                        <legend class="col-form-label">Was willst du tun?:</legend>
                        @foreach($kalender->types as $type)
                            @if($type->type !== 'Versammlung')
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="type" id="{{ $type->id }}" value="{{ $type->id }}"
                                    @if(old('type', $type->type))
                                        {{ old('type', $type->id) === $kalender->type[0]->id ? 'checked' : '' }}
                                        @else
                                        {{ 'checked' }}
                                        @endif>
                                    <label class="form-check-label" for="{{ $type->id }}">{{ $type->type }}</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <label for="description" class="form-label">Beschreibung:</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Hier bitte eintragen weshalb du in die Halle möchtest. (Kurz fassen)" value="@if(old('description', $kalender->description)) {{ old('description', $kalender->description) }} @endif">
                    </div>
                    <div class="col-md-6">
                        <legend class="col-form-label">Eigenes Fahrzeug:</legend>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="eigenesFZ" id="ja" value="Ja" @if(old('eigenesFZ', $kalender->eigenesFZ) == 1)
                                {{ old('eigenesFZ', $kalender->eigenesFZ) == 1 ? 'checked' : '' }}
                                @endif>
                            <label class="form-check-label" for="ja">Ja</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="eigenesFZ" id="nein" value="Nein" @if(old('eigenesFZ', $kalender->eigenesFZ) == 0)
                                {{ old('eigenesFZ', $kalender->eigenesFZ) == 0 ? 'checked' : '' }}
                                @endif>
                            <label class="form-check-label" for="nein">Nein</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary"><em class="bi bi-pen"></em> Termin ändern</button>
                </div>
            </form>


        </div>
    </section>
@endsection

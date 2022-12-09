@extends('layouts.app')

@section('title')
    Änderungen am Fahrzeug: {{ $fahrzeuge->title }}
@endsection
@section('description')
    {!! strip_tags(Str::limit('Hier kannst du Änderungen am Fahrzeug ' . $fahrzeuge->title . ' vornehmen.', 150)) !!}
@endsection
@section('robots', 'INDEX,FOLLOW')
@section('images')
    {{ asset($fahrzeuge->images) }}
@endsection

@section('content')
    <!-- ======= fahrzeuge Details Page ======= -->
    <section class="fahrzeuge" id="fahrzeuge">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="row fahrzeugeEdit">
                <form action="{{ route('frontend.fahrzeuge.update', $fahrzeuge->slug) }}" method="POST" id="form" enctype="multipart/form-data">
                    @include('helpers.component.recaptcha')
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="user_id" value="{{ $fahrzeuge->user_id }}">
                    <div class="col-lg-12 text-bg-dark shadow border-radius-10" data-aos="fade-up" data-aos-delay="100">
                        <div class="header">
                            <h1>Fahrzeugdaten</h1>
                        </div>
                        <div class="body">
                            <div class="row" id="showFahrzeugVorhanden">
                                <p class="trennung fw-bold lead">Solltest du mehrere Fahrzeuge besitzen, oder im Moment
                                    noch an einem Projekt arbeiten, so kannst du das nach erfolgreicher Annahme ganz
                                    einfach über dein Menü hinzufügen?</p>
                                <div class="col-lg-4 col-md-12 mb-3">
                                    @error('beschreibungFz')
                                    <label for="kategorie" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgewählt werden.">Kategorie:<small class="position-relative">*</small></label>
                                    @else
                                        <label for="kategorie" class="form-label fw-bold">Kategorie:<small class="position-relative">*</small></label>
                                        @enderror
                                        <select name="kategorie" id="kategorie" class="form-select form-select-sm @error('anlage') {{ 'Du musst eine Kategorie auswählen.' }} is-invalid @enderror">
                                            <option value="" selected>-- Kategorie wählen --</option>
                                            <option value="Fahrzeuge" {{ (old('kategorie') ?: $fahrzeuge->albums->kategorie) === 'Fahrzeuge' ? 'selected=selected' : '' }}>
                                                Fahrzeuge
                                            </option>
                                            <option value="Projekte" {{ (old('kategorie') ?: $fahrzeuge->albums->kategorie)  === 'Projekte' ? 'selected=selected' : '' }}>
                                                Projekte
                                            </option>
                                        </select>
                                </div>
                                <div class="col-lg-4 col-md-12 mb-3">
                                    <label for="fahrzeug" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Fahrzeug:<small class="position-relative">*</small></label>
                                    <input type="text" name="fahrzeug" id="fahrzeug" class="form-control form-control-sm @error('fahrzeug') is-invalid @enderror" value="{{ old('fahrzeug') ?: $fahrzeuge->title }}" maxlength="255" placeholder="Fahrzeug">
                                    @error('fahrzeug')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-4 col-md-12 mb-3">
                                    <label for="baujahr" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Baujahr:<small class="position-relative">*</small></label>
                                    <input type="text" name="baujahr" id="baujahr" class="form-control form-control-sm @error('baujahr') is-invalid @enderror" value="{{ old('baujahr') ?: $fahrzeuge->baujahr }}">
                                    @error('baujahr')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <small><span class="text-danger">Tipp:</span> unten
                                        <u class="text-success">rechts</u> auf Wörter klicken und es werden dir deine
                                        eingegebenen Zeichen angezeigt.</small>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="besonderheiten" class="form-label">Besonderheiten:</label>
                                    <textarea name="besonderheiten" id="besonderheiten" class="form-control form-control-sm @error('besonderheiten') is-invalid @enderror" placeholder="Besonderheiten">{!! old('besonderheiten') ?: $fahrzeuge->besonderheiten !!}</textarea>
                                    @error('besonderheiten')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    @error('motor')
                                    <label for="motor" class="form-label fw-bold text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Motor:<small class="position-relative">*</small>
                                        <span class="form-text text-danger">{{ $message }}</span></label>
                                    @else
                                        <label for="motor" class="form-label fw-bold" data-bs-toggle="tooltip" data-bs-placement="right" title="Muss ausgefüllt werden.">Motor:<small class="position-relative">*</small></label>
                                        @enderror
                                        <textarea name="motor" id="motor" class="form-control form-control-sm @error('motor') is-invalid @enderror" placeholder="Motor">{{ old('motor') ?: $fahrzeuge->motor }}</textarea>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="karosserie" class="form-label">Karosserie:</label>
                                    <textarea name="karosserie" id="karosserie" class="form-control form-control-sm @error('karosserie') is-invalid @enderror" placeholder="Karosserie">{{ old('karosserie') ?: $fahrzeuge->karosserie }}</textarea>
                                    @error('karosserie')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="felgen" class="form-label">Felgen:</label>
                                    <textarea name="felgen" id="felgen" class="form-control form-control-sm @error('felgen') is-invalid @enderror" placeholder="Felgen">{{ old('felgen') ?: $fahrzeuge->felgen }}</textarea>
                                    @error('felgen')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="fahrwerk" class="form-label">Fahrwerk:</label>
                                    <textarea name="fahrwerk" id="fahrwerk" class="form-control form-control-sm @error('fahrwerk') is-invalid @enderror" placeholder="Fahrwerk">{{ old('fahrwerk') ?: $fahrzeuge->fahrwerk }}</textarea>
                                    @error('fahrwerk')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="bremsen" class="form-label">Bremsen:</label>
                                    <textarea name="bremsen" id="bremsen" class="form-control form-control-sm @error('bremsen') is-invalid @enderror" placeholder="Bremsen">{{ old('bremsen') ?: $fahrzeuge->bremsen }}</textarea>
                                    @error('bremsen')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="innenraum" class="form-label">Innenraum:</label>
                                    <textarea name="innenraum" id="innenraum" class="form-control form-control-sm @error('innenraum') is-invalid @enderror" placeholder="Innenraum">{{ old('innenraum') ?: $fahrzeuge->innenraum }}</textarea>
                                    @error('innenraum')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <label for="anlage" class="form-label">Anlage:</label>
                                    <textarea name="anlage" id="anlage" class="form-control form-control-sm @error('anlage') is-invalid @enderror" placeholder="Anlage">{{ old('anlage') ?: $fahrzeuge->anlage }}</textarea>
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
                                        <textarea name="beschreibungFz" id="beschreibungFz" placeholder="Hier kannst du dein Fahrzeug beschreiben." class="form-control form-control-sm @error('beschreibungFz') is-invalid @enderror">{{ old('beschreibungFz') ?: $fahrzeuge->description }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12 text-bg-dark shadow border-radius-10 mt-4" data-aos="fade-up" data-aos-delay="100" id="showFahrzeugBilder">
                        <div class="header">
                            <h1>Fahrzeugbilder</h1>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    @if($fahrzeuge->albums->published)
                                        <span>Zum Löschen der Bilder einfach mit der Maus über die Bilder gehen, an mobilen Endgeräten draufklicken und auf den Papierkorb klicken (Standardbild wird automatisch ersetzt, sobald du ein neues Bild hochlädst).</span>
                                        <div class="d-flex flex-wrap justify-content-start">
                                            @foreach($photos as $photo)
                                                @if($photo->published)
                                                    <div class="d-flex flex-column justify-content-start img-wrapper">
                                                        @if(empty($photo->images))
                                                            <img src="{{ asset('images/default.png') }}" alt="{{ $photo->title }}" class="img-fluid shadow lozad">
                                                        @else
                                                            <img src="{{ asset('images/default.png') }}" data-src="{{ URL::asset($fahrzeuge->path.'/'.$photo->images_thumbnail) }}" alt="{{ $photo->title }}" class="img-fluid shadow lozad">
                                                            @if($photo->images !== $preview)
                                                                <div class="form-check imageDelete">
                                                                    <input class="form-check-input" type="checkbox" value="{{ $photo->id }}" name="imagesDelete[]" id="imagesDelete-{{ $photo->id }}">
                                                                    <input type="hidden" value="{{ $photo->images }}" name="imagesName[{{ $photo->images }}]">
                                                                    <input type="hidden" value="{{ $photo->id }}" name="imagesID[{{ $photo->id }}]">
                                                                    <label class="form-check-label" for="imagesDelete-{{ $photo->id }}">
                                                                        <em class="bi bi-trash"></em>
                                                                    </label>
                                                                </div>
                                                            @else
                                                                <div class="imageDelete" style="align-items: center; justify-content: center; color: #cccccc; top: 0; right: 0;">
                                                                    <div class="d-flex flex-column">
                                                                        <span>Vorschaubild kann nicht gelöscht werden.</span>
                                                                        <a href=""><em class="bi bi-link-45deg"></em>
                                                                            zum Album</a>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    @else
                                        <span>Es wurden noch keine Bilder zu diesem Fahrzeug hinzugefügt.</span>
                                        <input type="hidden" value="{{ $fahrzeuge->id }}" name="albumID">
                                    @endif
                                </div>
                                <div class="col-lg-12">
                                    <label for="images" class="form-label">Fahrzeugbilder: <small class="text-muted">(maximal
                                            10 Bilder gleichzeitig bei insgesamt 10 MB)</small></label>
                                    <input type="file" id="images" class="file" name="images[]" data-overwrite-initial="false" data-browse-on-zone-click="true" data-msg-placeholder="Wählen Sie {files} zum Hochladen aus ..." multiple>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end align-items-center my-3">
                                <a href="{{ route('frontend.fahrzeuge.show', $fahrzeuge->slug) }}" class="btn btn-secondary me-2">Zurück</a>
                                <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection

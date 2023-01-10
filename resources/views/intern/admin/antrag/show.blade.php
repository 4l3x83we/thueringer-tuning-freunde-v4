@extends('layouts.app')

@section('title') {{ Str::limit('Mitgliedsantrag von: ' . $antrag->vorname . ' ' . $antrag->nachname) }} @endsection
@section('description'){{ Str::limit('Mitgliedsantrag von: ' . $antrag->vorname . ' ' . $antrag->nachname . ' bearbeiten.') }}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="internAntrag" id="internAntrag">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="row" id="internAntragShow">
                <div class="col-12 text-bg-dark shadow background">
                    <div class="row my-3">
                        <div class="col-lg-12 mb-3">
                            <div class="text-center header @if($antrag->published) text-bg-success @else text-bg-danger @endif py-2 fw-bold shadow">Mitgliedsantrag #{{ $antrag->id }}</div>
                        </div>
                        <div class="@if(!$antrag->fahrzeug_vorhanden) col-lg-6 @else col-lg-12 @endif mb-3">
                            <div class="container p-3 shadow body h-100">
                                <div class="d-flex h4 align-items-center justify-content-center mb-3">Persönliche Daten:</div>
                                <div class="d-flex flex-column flex-md-row">
                                    <strong style="width: 33%;">Name:</strong>
                                    <p>
                                        <span>{{ $antrag->anrede }}</span>
                                        <span>{{ $antrag->vorname }}</span>
                                        <span>{{ $antrag->nachname }}</span>
                                    </p>
                                </div>
                                <div class="d-flex flex-column flex-md-row">
                                    <strong style="width: 33%;">Anschrift:</strong>
                                    <p>
                                        <span>{{ $antrag->straße }}</span><br>
                                        <span>{{ $antrag->plz }} {{ $antrag->wohnort }}</span>
                                    </p>
                                </div>
                                <div class="d-flex flex-column flex-md-row">
                                    <strong style="width: 33%;">Geburtsdatum:</strong>
                                    <p>
                                        <span>{{ \Carbon\Carbon::parse($antrag->geburtsdatum)->isoFormat('DD. MMMM YYYY') . ' / ' . $antrag->gebdatum }}</span>
                                    </p>
                                </div>
                                <div class="d-flex flex-column flex-md-row">
                                    <strong style="width: 33%;">Beruf:</strong>
                                    <p>
                                        <span>{{ $antrag->beruf }}</span>
                                    </p>
                                </div>
                                <div class="d-flex flex-column flex-md-row">
                                    <strong style="width: 33%;">Kontaktmöglichkeiten:</strong>
                                    <p>
                                        @if($antrag->telefon) <span>{{ $antrag->telefon .' /' }}</span> @endif <span>{{ $antrag->mobil }}</span><br>
                                        <span>{{ $antrag->email }}</span>
                                    </p>
                                </div>
                                @if($antrag->facebook or $antrag->twitter or $antrag->instagram)
                                    <div class="d-flex flex-column flex-md-row">
                                        <strong style="width: 33%;">Social Media:</strong>
                                        <p>
                                            @if($antrag->facebook) <a class="text-light fw-bold me-2" href="https://www.facebook.com/{{ $antrag->facebook }}"><em class="bi bi-facebook"></em></a> @endif
                                            @if($antrag->twitter) <a class="text-light fw-bold me-2" href="https://twitter.com/{{ $antrag->twitter }}"><em class="bi bi-twitter"></em></a> @endif
                                            @if($antrag->instagram) <a class="text-light fw-bold" href="https://www.instagram.com/{{ $antrag->instagram }}/"><em class="bi bi-instagram"></em></a> @endif
                                        </p>
                                    </div>
                                @endif
                                <div class="d-flex flex-column">
                                    <strong class="w-auto">Beschreibung:</strong>
                                    <p class="overflow-auto">{!! $antrag->description !!}</p>
                                </div>
                                @if($antrag->image)
                                    <div class="d-flex flex-column flex-md-row">
                                        <strong class="w-auto me-3">Profilbild:</strong>
                                        <img src="{{ asset($antrag->image) }}" class="img-thumbnail img-fluid profilImage" style="width: 156px; height: 153px; object-fit: cover; object-position: 50% 50%" alt="Profilbild: {{ $antrag->vorname . ' ' . $antrag->nachname }}">
                                    </div>
                                @endif
                            </div>
                        </div>
                        @if(!$antrag->fahrzeug_vorhanden)
                            <div class="col-lg-6 mb-3">
                                <div class="container p-3 shadow body h-100">
                                    <div class="d-flex h4 align-items-center justify-content-center mb-3">Fahrzeugdaten:</div>
                                    @if($antrag->fahrzeuge->title)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Fahrzeug:</strong>
                                            <p>{{ $antrag->fahrzeuge->title }}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->baujahr)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Baujahr:</strong>
                                            <p>{{ $antrag->fahrzeuge->baujahr }}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->besonderheiten)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Besonderheiten:</strong>
                                            <p>{!! $antrag->fahrzeuge->besonderheiten !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->motor)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Motor:</strong>
                                            <p>{!! $antrag->fahrzeuge->motor !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->karosserie)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Karosserie:</strong>
                                            <p>{!! $antrag->fahrzeuge->karosserie !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->felgen)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Felgen:</strong>
                                            <p>{!! $antrag->fahrzeuge->felgen !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->fahrwerk)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Fahrwerk:</strong>
                                            <p>{!! $antrag->fahrzeuge->fahrwerk !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->bremsen)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Bremsen:</strong>
                                            <p>{!! $antrag->fahrzeuge->bremsen !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->innenraum)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Innenraum:</strong>
                                            <p>{!! $antrag->fahrzeuge->innenraum !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->anlage)
                                        <div class="d-flex flex-column flex-md-row">
                                            <strong style="width: 33%;">Anlage:</strong>
                                            <p>{!! $antrag->fahrzeuge->anlage !!}</p>
                                        </div>
                                    @endif
                                    @if($antrag->fahrzeuge->description)
                                        <div class="d-flex flex-column">
                                            <strong class="w-auto">Beschreibung:</strong>
                                            <p class="overflow-auto">{!! $antrag->fahrzeuge->description !!}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if(count($antrag->photos) > 0)
                                <div class="col-lg-12 mb-3">
                                    <div class="container p-3 shadow body h-100">
                                        <div class="d-flex h4 align-items-center justify-content-center mb-3">Fahrzeugbilder:</div>
                                        <div class="d-flex flex-wrap">
                                            @foreach($antrag->photos as $photo)
                                                <img src="{{ asset($antrag->fzPath.'/'.$photo->images) }}" class="img-thumbnail img-fluid carImage" alt="Fahrzeugbild: {{ $photo->images }}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if(!$antrag->published)
                            <div class="col-lg-12">
                                <form action="{{ route('intern.admin.antrag.checked-antrag', $antrag->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div class="container p-3 shadow body h-100">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="h-100">
                                                    <div class="row mb-3">
                                                        <label for="titel" class="col-sm-3 col-form-label col-form-label-sm">Titel:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm @error ('title') is-invalid @enderror" id="title" name="title" maxlength="255" value="{{ $antrag->vorname }}">
                                                            @error('title')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label for="published_at" class="col-sm-3 col-form-label col-form-label-sm">Mitglied seit:</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control form-control-sm @error ('published_at') is-invalid @enderror" id="published_at" name="published_at" maxlength="255" value="{{ \Carbon\Carbon::parse(now())->isoFormat('DD.MM.YYYY') }}">
                                                            @error('published_at')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <label for="funktion" class="col-sm-3 col-form-label col-form-label-sm">Funktion:</label>
                                                        <div class="col-sm-9">
                                                            <select class="form-select form-select-sm @error ('funktion') is-invalid @enderror" id="funktion" name="funktion">
                                                                <option value="Clubmitglied" selected>Clubmitglied</option>
                                                                <option value="Passives Mitglied">Passives Mitglied</option>
                                                                <option value="Gründungsmitglied & Webmaster">Gründungsmitglied & Webmaster</option>
                                                                <option value="Gründungsmitglied & Chef">Gründungsmitglied & Chef</option>
                                                            </select>
                                                            @error('funktion')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="d-flex flex-column align-items-end h-100">
                                                    <div class="mt-auto">
                                                        <input type="hidden" name="is_checked" value="1">
                                                        @if(!$antrag->fahrzeug_vorhanden)
                                                            <input type="hidden" name="album_id" value="{{ $antrag->fahrzeuge->album_id }}">
                                                            <input type="hidden" name="fahrzeug_id" value="{{ $antrag->fahrzeug_id }}">
                                                            <input type="hidden" name="titleFz" value="{{ $antrag->fahrzeuge->title }}">
                                                            <input type="hidden" name="nameFz" value="{{ $antrag->fahrzeuge->name }}">
                                                            <input type="hidden" name="slugFz" value="{{ $antrag->fahrzeuge->slug }}">
                                                        @endif
                                                        <button class="btn btn-sm btn-success" type="submit"><em class="bi bi-check-circle"></em> Freigeben</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @else
                            <form action="{{ route('intern.admin.antrag.revoke-antrag', $antrag->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="container p-3 shadow body h-100">
                                    <div class="row">
                                        <div class="col-lg-12 text-end">
                                            <input type="hidden" name="is_checked" value="0">
                                            @if(!$antrag->fahrzeug_vorhanden)
                                                <input type="hidden" name="antrag_id" value="{{ $antrag->id }}">
                                                <input type="hidden" name="album_id" value="{{ $antrag->fahrzeuge->album_id }}">
                                                <input type="hidden" name="slugFz" value="{{ $antrag->fahrzeuge->slug }}">
                                                <input type="hidden" name="slugTeam" value="{{ $antrag->slug }}">
                                            @endif
                                            <button class="btn btn-sm btn-danger" type="submit"><em class="bi bi-x-circle"></em> Zurückziehen </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif

                        @hasanyrole('super_admin|admin')
                        <div class="col-lg-12 mt-3">
                            <div class="container p-3 shadow body h-100">
                                <div class="d-flex justify-content-end align-items-center">
                                    <form action="{{ route('intern.admin.antrag.destroy', $antrag->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        @foreach($antrag->fahrzeuges as $item)
                                            <input type="hidden" name="albenID[]" value="{{ $item->album_id }}">
                                        @endforeach
                                        <button type="submit" class="btn btn-sm btn-danger"><em class="bi bi-trash"></em> Löschen</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endhasanyrole

                        <div class="col-lg-12 mt-3">
                            <div class="text-end pe-3"><small>IP Adresse: {{ $antrag->ip_adresse }}</small></div>
                            <div class="text-end pe-3"><small>Erstellt am: {{ \Carbon\Carbon::parse($antrag->created_at)->isoFormat('DD. MMM. YYYY HH:mm:ss') }}</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@extends('layouts.app')

@section('title'){{ $galerie->title . ' | ' . $galerie->photoCount . ' Fotos im Album' }}@endsection
@section('description'){!! strip_tags(Str::limit($galerie->description, 155)) !!}@endsection
@section('robots', 'INDEX,FOLLOW')
@section('images'){{ asset($galerie->images) }}@endsection

@section('content')
    <!-- ======= Gallery Details Page ======= -->
    <section class="galerie-details" id="galerie-details">
        <div class="container" data-aos="fade">
            <h1 class="d-none">@yield('description')</h1>
            <div class="row gy-4">

                <div class="col-lg-8 galerie-details-list">
                    <article>
                        @foreach($galerie->photos as $photo)
                            @if($photo->published_at <= now() and $photo->published)
                                <div class="figure shadow">
                                    <div class="inner" @if($photo->images === $galerie->images) style="border: 1px solid green;" @endif>
                                        <div class="thumbnails">
                                            @if(empty($photo->images))
                                                <img src="{{ asset('images/default.png') }}" alt="{{ $photo->title . ' ID: #' . $photo->id }}" class="img-fluid lozad">
                                            @else
                                                <img src="{{ asset('images/default.png') }}" data-src="{{ asset($galerie->path.'/'.$photo->images_thumbnail) }}" alt="{{ $photo->title . ' ID: #' . $photo->id }}" class="img-fluid lozad">
                                            @endif
                                        </div>
                                        @hasanyrole('mitglied|super_admin|admin')
                                        <div class="caption description">
                                            <div class="text-center mb-2">
                                                @if(empty($photo->images))
                                                    <a href="{{ asset('images/default.png') }}" class="btn btn-sm btn-primary my-2" data-fancybox="images" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vollbild">
                                                        <em class="bi bi-arrows-fullscreen"></em>
                                                    </a>
                                                @else
                                                    <a href="{{ asset($galerie->path.'/'.$photo->images) }}" data-thumb="{{ asset($galerie->path.'/'.$photo->images_thumbnail) }}" class="btn btn-sm btn-primary my-2" data-fancybox="images" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vollbild">
                                                        <em class="bi bi-arrows-fullscreen"></em>
                                                    </a>
                                                @endif

                                                @if(auth()->user()->id === $photo->user_id)
                                                    @if($photo->id !== $galerie->thumbnail_id)
                                                        <form action="{{ route('frontend.albums.update-preview', $photo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vorschaubild">
                                                            @include('frontend.component.galerie.forms.updatePreview')
                                                        </form>
                                                            @include('frontend.component.galerie.forms.deletePhoto')
                                                    @else
                                                        @include('frontend.component.galerie.forms.preview')
                                                    @endif
                                                @elseif($galerie->kategorie === 'Treffen' or $galerie->kategorie === 'Club-interne-Treffen')
                                                    @if(auth()->user()->id === $photo->user_id)
                                                        @if($photo->id !== $galerie->thumbnail_id)
                                                            @can('edit')
                                                                <form action="{{ route('frontend.albums.update-preview', $photo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vorschaubild">
                                                                    @include('frontend.component.galerie.forms.updatePreview')
                                                                </form>
                                                            @endcan

                                                            @can('destroy')
                                                                @include('frontend.component.galerie.forms.deletePhoto')
                                                            @endcan
                                                        @else
                                                            @include('frontend.component.galerie.forms.preview')
                                                        @endif
                                                    @endif
                                                @endif
                                                @hasanyrole('super_admin|admin')
                                                    @if(auth()->user()->id !== $photo->user_id)
                                                        @if($photo->id !== $galerie->thumbnail_id)
                                                            <form action="{{ route('frontend.albums.update-preview', $photo->id) }}" method="POST" enctype="multipart/form-data" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vorschaubild">
                                                                @include('frontend.component.galerie.forms.updatePreview')
                                                            </form>
                                                            @include('frontend.component.galerie.forms.deletePhoto')
                                                        @else
                                                            @include('frontend.component.galerie.forms.preview')
                                                        @endif
                                                    @endif
                                                @endhasanyrole
                                            </div>
                                        </div>
                                        @endhasanyrole
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </article>
                </div>

                <div class="col-lg-4">
                    <div class="portfolio-info shadow border-radius-10">
                        <div class="d-flex justify-content-between headline">
                            <h3>{{ $galerie->title }}</h3>
                            <a href="{{ route('frontend.galerie.index') }}"><em class="bi bi-arrow-left"></em> Zurück</a>
                        </div>
                        <ul>
                            <li><strong>Kategorie</strong>: {{ $galerie->kategorie }}</li>
                            <li><strong>Mitglied</strong>: {{ $galerie->userName }}</li>
                            <li><strong>Erstellt am</strong>: {{ \Carbon\Carbon::parse($galerie->created_at)->isoFormat('DD MMM. YYYY') }}</li>
                            <li><strong>Zuletzt aktualisiert</strong>: {{ \Carbon\Carbon::parse($galerie->updated_at)->fromNow() }}</li>
                            @if($galerie->kategorie === 'Fahrzeuge' or $galerie->kategorie === 'Projekte')
                                <li><a href="{{ route('frontend.fahrzeuge.show', $galerie->slug) }}" class="links-light"><strong><em class="bi bi-car-front"></em></strong>: zum Fahrzeug</a></li>
                            @endif
                            @hasanyrole('mitglied|super_admin|admin')
                                @if($galerie->kategorie === 'Treffen' or $galerie->kategorie === 'Club-interne-Treffen' or empty($galerie->fahrzeug_id))
                                    @can('edit')
                                        @if($galerie->user_id === auth()->user()->id)
                                            <li><a data-bs-toggle="modal" data-id="{{ $galerie->id }}" data-bs-target="#galerieEditModal" class="editAlbum links-light-cursor"><strong><em class="bi bi-images"></em></strong>: Bearbeiten</a></li>
                                        @else
                                            @hasanyrole('super_admin|admin')
                                                <li><a data-bs-toggle="modal" data-id="{{ $galerie->id }}" data-bs-target="#galerieEditModal" class="editAlbum links-light-cursor"><strong><em class="bi bi-images"></em></strong>: Bearbeiten</a></li>
                                            @endhasanyrole
                                        @endif
                                    @endcan
                                    @can('destroy')
                                        @if($galerie->user_id === auth()->user()->id)
                                            <li>
                                                <a class="delete links-light-cursor" data-bs-toggle="modal" data-id="{{ $galerie->id }}" data-bs-target="#galerieModal">
                                                    <strong><em class="bi bi-trash text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Löschen"></em></strong>: Löschen
                                                </a>
                                            </li>
                                        @else
                                            @hasanyrole('super_admin|admin')
                                                <li>
                                                    <a class="delete links-light-cursor" data-bs-toggle="modal" data-id="{{ $galerie->id }}" data-bs-target="#galerieModal">
                                                        <strong><em class="bi bi-trash text-danger fw-bold" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Löschen"></em></strong>: Löschen
                                                    </a>
                                                </li>
                                            @endhasanyrole
                                        @endif
                                    @endcan
                                @else
                                    @if($galerie->user_id === auth()->user()->id)
                                        <li>
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Das Album oder die Bilder kannst du unter Fahrzeuge bearbeiten, um einzelne Bilder zu löschen, fahre mit der Maus über das Bild oder klicke am mobilen Endgerät auf das Bild. Du kannst nur Bilder löschen oder bearbeiten, die du auch hochgeladen hast." class="text-danger">
                                                <em class="bi bi-question-circle fw-bold"></em>: <a class="text-danger" href="{{ route('frontend.galerie.edit', $galerie->slug) }}#showFahrzeugBilder">Fahrzeugbilder bearbeiten</a>
                                            </span>
                                        </li>
                                    @else
                                        @hasanyrole('super_admin|admin')
                                            <li>
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Das Album oder die Bilder kannst du unter Fahrzeuge bearbeiten, um einzelne Bilder zu löschen, fahre mit der Maus über das Bild oder klicke am mobilen Endgerät auf das Bild. Du kannst nur Bilder löschen oder bearbeiten, die du auch hochgeladen hast." class="text-danger">
                                                    <em class="bi bi-question-circle fw-bold"></em>: <a class="text-danger" href="{{ route('frontend.fahrzeuge.edit', $galerie->slug) }}#showFahrzeugBilder">Fahrzeugbilder bearbeiten</a>
                                                </span>
                                            </li>
                                        @endhasanyrole
                                    @endif
                                @endif
                            @endhasanyrole
                        </ul>
                        <div class="portfolio-description">
                            <p>{!! $galerie->description !!}</p>
                        </div>

                        <div class="legende">
                            <div class="fw-bold">Legende: </div>
                            <div>
                                <div class="btn btn-sm btn-primary my-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vollbild">
                                    <em class="bi bi-arrows-fullscreen"></em>
                                </div>
                                <span> = Vollbild</span>
                            </div>
                            @hasanyrole('mitglied|super_admin|admin')
                                @if(auth()->user()->id === $galerie->user_id)
                                    <div>
                                        <div class="btn btn-sm btn-secondary my-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vorschaubild">
                                            <em class="bi bi-eye"></em>
                                        </div>
                                        <span> = Vorschaubild festlegen</span>
                                    </div>
                                    <div>
                                        <div class="btn btn-sm btn-danger my-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Löschen">
                                            <em class="bi bi-trash"></em>
                                        </div>
                                        <span> = Bild löschen</span>
                                    </div>
                                @endif
                                @hasanyrole('super_admin|admin')
                                    @if(auth()->user()->id !== $galerie->user_id)
                                        <div class="fw-bold">Admin Icons: </div>
                                        <div class="ms-3">
                                            <div class="btn btn-sm btn-outline-secondary my-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Vorschaubild">
                                                <em class="bi bi-eye"></em>
                                            </div>
                                            <span> = Vorschaubild festlegen</span>
                                        </div>
                                        <div class="ms-3">
                                            <div class="btn btn-sm btn-outline-danger my-1" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Löschen">
                                                <em class="bi bi-trash"></em>
                                            </div>
                                            <span> = Bild löschen</span>
                                        </div>
                                    @endif
                                @endhasanyrole
                            @endhasanyrole
                        </div>

                        @hasanyrole('mitglied|super_admin|admin')
                            @if($galerie->kategorie === 'Treffen' or $galerie->kategorie === 'Club-interne-Treffen')
                                @can('edit')
                                <div class="imagesDirekt">
                                    <form action="{{ route('frontend.photos.store') }}" method="POST" enctype="multipart/form-data">
                                        @include('frontend.component.galerie.forms.imagesUpload')
                                    </form>
                                </div>
                                @endcan
                            @else
                                @if(auth()->user()->id === $galerie->user_id)
                                <div class="imagesDirekt" id="imagesDirekt">
                                    <form action="{{ route('frontend.photos.store') }}" method="POST" enctype="multipart/form-data">
                                        @include('frontend.component.galerie.forms.imagesUpload')
                                    </form>
                                </div>
                                @endif
                            @endif
                        @endhasanyrole
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="galerieEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="galerieEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('frontend.galerie.update', $galerie->slug) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="id" id="idEdit">
                    <input type="hidden" name="previewImage" value="{{ $galerie->images }}">
                    <input type="hidden" name="previewSlug" value="{{ $galerie->slug }}">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        @include('frontend.component.galerie.edit')
                        <div class="d-flex justify-content-end mt-3">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Nein</button>
                            @can('write')
                                <button type="submit" class="btn btn-primary">Änderungen Speichern</button>
                            @endcan
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="galerieModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="galerieModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('frontend.galerie.destroy', $galerie->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <h5 class="my-5">Willst du die Galerie "{{ $galerie->title }}" wirklich löschen?</h5>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Nein</button>
                            <button type="submit" class="btn btn-primary">Ja! Lösche sie</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="photoModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('frontend.photos.destroy', $galerie->slug) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" id="idPhoto">
                    <div class="modal-body">
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <h5 class="my-5">Willst du das Foto wirklich löschen?</h5>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Nein</button>
                            <button type="submit" class="btn btn-primary">Ja! Lösche es</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="module">
        $('.delete').click(function () {
            let id = $(this).data('id');
            $('#id').val(id);
        });
        $('.deletePhoto').click(function () {
            let id = $(this).data('id');
            $('#idPhoto').val(id);
        });
        $('.editAlbum').click(function () {
            let id = $(this).data('id');
            $('#idEdit').val(id);
        });
    </script>
@endpush

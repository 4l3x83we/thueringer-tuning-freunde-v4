@if(count($team->alben) > 0)
    <div class="tab-pane fade" id="galerie" role="tabpanel" aria-labelledby="galerie-tab">
        <div class="header" style="border-radius: 0 10px 0 0;">
            <h5>Galerieübersicht von {{ $team->vorname . ' ' . $team->nachname }}</h5>
        </div>
        <div class="body">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <p>Hier siehst du eine Übersicht über deine gesamten Alben oder hochgeladen Bilder sehen.</p>
                    <p class="m-0">Du hast insgesamt: {{ count($team->alben) }} Alben und {{ count($team->photos) }} Fotos bei uns auf der Webseite.</p>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="table-responsive">
                        <table id="galerieTable" class="table table-striped table-hover">
                            <thead>
                            <tr class="fw-bold">
                                <td style="min-width: 60px;">#ID</td>
                                <td style="min-width: 300px;">Name</td>
                                <td style="min-width: 100px;">Kategorie</td>
                                <td style="min-width: 100px;">Größe</td>
                                <td style="width: 120px;">Veröffentlicht</td>
                                <td class="text-end">Aktion</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($team->alben as $key => $alben)
                                @if($alben->kategorie !== 'Fahrzeuge' or $alben->kategorie !== 'Projekt')
                                    <tr>
                                        <td id="galerie" class="align-middle" href="{{ route('frontend.galerie.show', $alben->slug) }}">#{{ str_pad($key + 1, 2, 0, STR_PAD_LEFT) }}</td>
                                        <td id="galerie" class="align-middle" href="{{ route('frontend.galerie.show', $alben->slug) }}">{{ $alben->title }}</td>
                                        <td id="galerie" class="align-middle" href="{{ route('frontend.galerie.show', $alben->slug) }}">{{ \App\Helpers\Helpers::replaceBlankMinus($alben->kategorie) }}</td>
                                        <td id="galerie" class="align-middle" href="{{ route('frontend.galerie.show', $alben->slug) }}">{{ $alben->size }}</td>
                                        <td id="galerie" class="align-middle" href="{{ route('frontend.galerie.show', $alben->slug) }}">{{ \Carbon\Carbon::parse($alben->published_at)->isoFormat('DD.MM.YYYY') }}</td>
                                        <td class="align-middle text-end">
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                                @if($alben->published)
                                                    <form action="{{ route('intern.galerie.published-galerie', $alben->slug) }}" method="POST" class="d-inline-block">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-info" @if($alben->kategorie === 'Treffen' or $alben->kategorie === 'Club-interne-Treffen') style="border-radius: 0.25rem 0 0 0.25rem; @endif"><em class="bi bi-x-circle"></em></button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('intern.galerie.published-galerie', $alben->slug) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success" @if($alben->kategorie === 'Treffen' or $alben->kategorie === 'Club-interne-Treffen') style="border-radius: 0.25rem 0 0 0.25rem; @endif"><em class="bi bi-check-circle"></em></button>
                                                    </form>
                                                @endif
                                                @if($alben->kategorie === 'Treffen' or $alben->kategorie === 'Club-interne-Treffen')
                                                    <button type="button" class="delete btn btn-sm btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-bs-toggle="modal" data-id="{{ $alben->id }}" data-bs-target="#galerieInternModal-{{ $alben->id }}"><em class="bi bi-trash"></em></button>
                                                    <script type="module">
                                                        $('.delete').click(function () {
                                                            let id = $(this).data('id');
                                                            $('#id-.{{ $alben->id }}').val(id);
                                                        });
                                                    </script>
                                                @endif

                                                <!-- Modal -->
                                                <div class="modal fade" id="galerieInternModal-{{ $alben->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="galerieInternModal-{{ $alben->id }}-Label" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <form action="{{ route('frontend.galerie.destroy', $alben->slug) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <input type="hidden" name="id" id="id-.{{ $alben->id }}">
                                                                <div class="modal-body">
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <h5 class="my-5 text-start">Willst du die Galerie "{{ $alben->title }}" wirklich löschen?</h5>
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Nein</button>
                                                                        <button type="submit" class="btn btn-primary">Ja! Lösche sie</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td id="photoTable" colspan="6">
                                            <form action="{{ route('intern.galerie.photos.destroy-photo', $alben->slug) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <article>
                                                    @foreach($team->photos as $photo)
                                                        @if($alben->id === $photo->album_id)
                                                            <div class="figure">
                                                                <div class="inner">
                                                                    <div class="thumbnails">
                                                                        <img class="lozad" src="{{ asset('images/default.png') }}" data-src="{{ asset($alben->path.'/'.$photo->images_thumbnail) }}" alt="{{ $photo->title . ' #' . $photo->id }}">
                                                                    </div>
                                                                </div>
                                                                <div class="form-check imageDelete" style="margin-left: 5px;">
                                                                    <input class="form-check-input" type="checkbox" value="{{ $photo->id }}" name="imagesDelete[]" id="imagesDelete-{{ $photo->id }}">
                                                                    <input type="hidden" value="{{ $photo->images }}" name="imagesName[{{ $photo->images }}]">
                                                                    <input type="hidden" value="{{ $photo->id }}" name="imagesID[{{ $photo->id }}]">
                                                                    <label class="form-check-label" for="imagesDelete-{{ $photo->id }}" style="margin-top: 2px;">
                                                                        <em class="bi bi-trash"></em>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </article>
                                                <button class="btn btn-sm btn-danger mb-2"><em class="bi bi-trash"></em> Ausgewählte Bilder löschen</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="d-flex justify-content-end align-items-center">
                        <span>Legende: <em class="bi bi-check-circle text-success"></em> = Veröffentlichen, <em class="bi bi-x-circle text-info"></em> = Ausblenden, <em class="bi bi-trash text-danger"></em> = Löschen</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

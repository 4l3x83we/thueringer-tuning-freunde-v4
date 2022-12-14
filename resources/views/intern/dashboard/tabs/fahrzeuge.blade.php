@if(count($team->fahrzeuge) > 0)
    <div class="tab-pane fade" id="fahrzeuge" role="tabpanel" aria-labelledby="fahrzeuge-tab">
        <div class="header" style="border-radius: 0 10px 0 0;">
            <h5>Fahrzeugübersicht von {{ $team->vorname . ' ' . $team->nachname }}</h5>
        </div>
        <div class="body">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <p>Hier hast du eine Übersicht über deine Fahrzeuge.</p>
                    <p class="m-0">Du hast insgesamt: {{ count($team->fahrzeuge) }} Fahrzeuge bei uns auf der Webseite.</p>
                </div>
                <div class="col-lg-12 mb-3">
                    <div class="table-responsive">
                        <table id="fahrzeugeTable" class="table table-striped table-hover">
                            <thead>
                            <tr class="fw-bold">
                                <td style="min-width: 60px;" class="align-middle">#ID</td>
                                <td style="min-width: 300px;" class="align-middle">Name</td>
                                <td style="min-width: 100px;" class="align-middle">Album</td>
                                <td style="width: 120px;" class="align-middle">Veröffentlicht</td>
                                <td class="text-end align-middle">Aktion</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($team->fahrzeuge as $key => $fahrzeug)
                                <tr>
                                    <td class="fahrzeuge align-middle">{{ $key + 1 }}</td>
                                    <td class="fahrzeuge align-middle">
                                        @if($fahrzeug->path)
                                            <img src="{{ asset($preview[$fahrzeug->album_id]) }}" alt="{{ $fahrzeug->fahrzeug . ' #' . $fahrzeug->id }}" style="width: 33px; height: 33px; object-fit: cover; object-position: 50% 50%;" class="lozad img-thumbnail">
                                        @endif
                                            {{ $fahrzeug->title }}
                                    </td>
                                    <td class="align-middle">
                                        <a href="{{ route('frontend.galerie.show', $fahrzeug->slug) }}" class="links-light"><em class="bi bi-images"></em> zum Album</a>
                                    </td>
                                    <td class="fahrzeuge align-middle">
                                        @if($fahrzeug->published)
                                            {{ \Carbon\Carbon::parse($fahrzeug->published_at)->isoFormat('DD.MM.YYYY') }}
                                        @endif
                                    </td>
                                    <td class="align-middle text-end">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic mixed styles example">
                                            @if($fahrzeug->published)
                                                <form action="{{ route('frontend.fahrzeuge.unpublished', $fahrzeug->slug) }}" method="POST" class="d-inline-block">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-info" style="border-radius: 0.25rem 0 0 0.25rem;"><em class="bi bi-x-circle"></em></button>
                                                </form>
                                            @else
                                                <form action="{{ route('frontend.fahrzeuge.published', $fahrzeug->slug) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-sm btn-success" style="border-radius: 0.25rem 0 0 0.25rem;"><em class="bi bi-check-circle"></em></button>
                                                </form>
                                            @endif
                                            <button type="button" class="delete btn btn-sm btn-danger" style="border-radius: 0 0.25rem 0.25rem 0;" data-bs-toggle="modal" data-id="{{ $fahrzeug->id }}" data-bs-target="#fahrzeugeInternModal-{{ $fahrzeug->id }}"><em class="bi bi-trash"></em></button>
                                            <script type="module">
                                                $('.deleteFahrzeuge').click(function () {
                                                    let id = $(this).data('id');
                                                    $('#id-.{{ $fahrzeug->id }}').val(id);
                                                });
                                            </script>

                                            <!-- Modal -->
                                            <div class="modal fade" id="fahrzeugeInternModal-{{ $fahrzeug->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="fahrzeugeInternModal-{{ $fahrzeug->id }}-Label" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <form action="{{ route('frontend.fahrzeuge.destroy', $fahrzeug->slug) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="id" id="id-{{ $fahrzeug->id }}">
                                                            <input type="hidden" name="albumDirectory" value="{{ $fahrzeug->album_id }}">
                                                            @foreach($team->alben as $alben)
                                                                @if($alben->id === $fahrzeug->album_id)
                                                                    @foreach($team->photos as $photo)
                                                                        @if($photo->album_id ===  $fahrzeug->album_id)
                                                                            <input type="hidden" name="photos[]" value="{{ $photo->id }}">
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                            <div class="modal-body">
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <h5 class="my-5 text-start">Willst du das Fahrzeug <span class="fw-bold text-danger">"{{ $fahrzeug->title }}"</span> und die dazugehörigen <span class="fw-bold text-danger">Bilder und Alben</span> wirklich löschen?</h5>
                                                                <div class="d-flex justify-content-end">
                                                                    <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Nein</button>
                                                                    <button type="submit" class="btn btn-primary">Ja! Lösche es</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
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

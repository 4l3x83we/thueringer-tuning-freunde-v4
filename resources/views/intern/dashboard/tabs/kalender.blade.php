<div class="tab-pane fade" id="kalender" role="tabpanel" aria-labelledby="kalender-tab">
    <div class="header" style="border-radius: 0 10px 0 0;">
        <h5>Kalendereinträge von {{ $team->vorname . ' ' . $team->nachname }}</h5>
    </div>

    <div class="body">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <p>Hier hast du eine Übersicht über deine Kalendereinträge.</p>
                <p class="m-0">Du hast aktuell: {{ count($team->kalender) }} Kalendereintäge auf der Webseite.</p>
            </div>
            <div class="col-lg-12 mb-3">
                <div class="table-responsive p-3">
                    <table id="fahrzeugeTable" class="table table-striped table-hover">
                        <thead>
                        <tr class="fw-bold">
                            <td style="width: 100px;" class="align-middle">Datum von</td>
                            <td style="width: 100px;" class="align-middle">Datum bis</td>
                            <td style="width: 100px;" class="align-middle">Kontaktperson</td>
                            <td style="min-width: 300px;" class="align-middle">Beschreibung</td>
                            <td style="width: 120px;" class="align-middle">Angenommen</td>
                            <td class="text-end align-middle">Aktion</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($team->kalender as $kalender)
                            <tr>
                                <td colspan="6" class="text-center align-middle fw-bold {{ $kalender->type->typeColor }}">{{ $kalender->type->type }}</td>
                            </tr>
                            <tr>
                                <td class="align-middle text-center">{{ \Carbon\Carbon::parse($kalender->von)->isoFormat('DD.MM.YYYY HH:mm') }}</td>
                                <td class="align-middle text-center">{{ \Carbon\Carbon::parse($kalender->bis)->isoFormat('DD.MM.YYYY HH:mm') }}</td>
                                <td class="align-middle text-center">
                                    <div class="d-flex flex-column">
                                        @foreach($teams as $teamMitglied)
                                            @if($teamMitglied->user_id === $kalender->type->cp_user_id)
                                                <div class="d-flex flex-row justify-content-center">
                                                    <a href="mailto:{{ $teamMitglied->email }}?subject=Frage zum {{ $kalender->type->type }} Termin am {{ \Carbon\Carbon::parse($kalender->von)->isoFormat('DD.MM.YYYY HH:mm') . ' Uhr bis ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('DD.MM.YYYY HH:mm') }} Uhr.&bcc={{ auth()->user()->email }}&body=Hallo {{ $teamMitglied->vorname }},%0D%0A%0D%0A" class="links-light btn btn-sm btn-link"><em class="bi bi-envelope"></em></a>
                                                    <a href="https://wa.me/{{ $teamMitglied->mobil }}?text=Hallo {{ $teamMitglied->vorname }},%20%20frage zum {{ $kalender->type->type }} Termin am {{ \Carbon\Carbon::parse($kalender->von)->isoFormat('DD.MM.YYYY HH:mm') . ' Uhr bis ' . \Carbon\Carbon::parse($kalender->bis)->isoFormat('DD.MM.YYYY HH:mm') }} Uhr." class="links-light btn btn-sm btn-link" target="_blank"><em class="bi bi-whatsapp"></em></a>
                                                    <a href="tel:{{ $teamMitglied->mobil }}" class="links-light btn btn-sm btn-link" target="_blank"><em class="bi bi-telephone"></em></a>
                                                </div>
                                                {{ $teamMitglied->vorname }}
                                            @endif
                                        @endforeach
                                    </div>
                                </td>
                                <td class="align-middle">{!! $kalender->description !!}</td>
                                <td class="align-middle">{{ \Carbon\Carbon::parse($kalender->published_at)->isoFormat('DD.MM.YYYY') }}</td>
                                <td class="align-middle"></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

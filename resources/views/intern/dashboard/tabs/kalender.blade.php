@if(count($team->kalender) > 0)
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
                <div class="table-responsive">
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
                            @if($kalender->type->typeColor === 'ver')
                                @include('intern.dashboard.tabs.kalender.kalender')
                                @include('intern.dashboard.tabs.kalender.assumed')
                            @else
                                @if($kalender->team_id === $team->id or $kalender->type->cp_user_id === $team->id)
                                    @include('intern.dashboard.tabs.kalender.kalender')
                                @endif
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="editPayment-{{ $team->id }}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="editPaymentLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('intern.admin.zahlungen.update', $team->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-start" id="editPaymentLabel">Zahlung anpassen
                        von {{ $team->vorname . ' ' . $team->nachname }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <div class="row g-5">
                        <div class="col-lg-6">
                            <legend class="col-form-label">Zahlungsart:</legend>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="zahlungsart" id="zahlungsart1" value="wb" @if($team->zahlungsArt)
                                    {{ $team->zahlungsArt === 'wb' ? 'checked' : '' }}
                                    @endif>
                                <label class="form-check-label" for="zahlungsart1">Werkstattbeteiligung</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="zahlungsart" id="zahlungsart2" value="mb" @if($team->zahlungsArt)
                                    {{ $team->zahlungsArt === 'mb' ? 'checked' : '' }}
                                    @endif>
                                <label class="form-check-label" for="zahlungsart2">Mitgliedsbeitrag</label>
                            </div>
                            @error('zahlungsArt')
                            <span class="form-text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6" id="zahlungsArtWB">
                            <label for="zahlung" class="form-label">Zahlung:</label>
                            <input type="number" min="0" max="6" class="form-control @error('zahlung') is-invalid @enderror" name="zahlung" id="zahlung" value="{{ old('zahlung', $team->zahlung) ? $team->zahlung : 0 }}">
                        </div>
                        <div class="col-lg-6" id="zahlungsArtMB">
                            <label for="zahlung" class="form-label">Zahlung:</label><br>
                            <span>Es gibt nur 20,00 € Mitgliedsbeitrag hier kannst du nichts ändern.</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary">Speichern</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="module">
    $(document).ready(function () {
        let checkWb = $('#zahlungsart1').prop('checked');
        let checkMb = $('#zahlungsart2').prop('checked');
        /*if (checkWb == true || checkMb == false) {
            $('#zahlungsArtWB').toggle(true);
            $('#zahlungsArtMB').toggle(false);
        } else if (checkMb == true || checkWb == false) {
            $('#zahlungsArtMB').toggle(true);
            $('#zahlungsArtWB').toggle(false);
        }*/
    });
</script>

<!-- Modal -->
<div class="modal fade" id="assumedUpdate" tabindex="-1" aria-labelledby="assumedUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <form action="{{ route('intern.kalenders.assumed_meeting', $kalender->id) }}" method="POST">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="assumedUpdateLabel">Anwesend/Abwesend</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="email" value="{{ $team->email }}">
                    <input type="hidden" name="team_id" value="{{ $team->id }}">
                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <span class="text-danger fw-bold">Achtung: Du erhältst am Sonntag vor der Versammlung eine automatische E-Mail.</span>
                        </div>
                        <div class="col-md-6">
                            <legend class="col-form-label">Bist du dabei?:</legend>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="present" id="present1" value="1" onChange="toggleDiv('1')" checked>
                                <label class="form-check-label" for="present1">
                                    Anwesend
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="present" id="present2" value="0" onChange="toggleDiv('0')">
                                <label class="form-check-label" for="present2">
                                    Abwesend
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6" id="memory">
                            <label for="memory" class="form-label">Terminerinnerung (in Tagen) (0 = keine Benachrichtigung)</label>
                            <input type="number" min="0" max="6" class="form-control @error('memory') is-invalid @enderror" name="memory" id="memory" value="{{ old('memory') ?: 0 }}">
                        </div>
                        <div class="col-md-12" id="memory-email">
                            <span>Deine E-Mail-Benachrichtigung geht an folgende E-Mail-Adresse: <strong>{{ $team->email }}</strong></span>
                        </div>
                        <div class="col-md-12" id="cancel" style="display: none;">
                            <label for="cancellation_reason" class="form-label">Absagegrund:</label>
                            <input type="text" class="form-control @error('cancellation_reason') is-invalid @enderror" name="cancellation_reason" id="cancellation_reason" placeholder="Hier bitte eintragen warum du nicht kannst." value="@if(old('cancellation_reason')) {{ old('cancellation_reason') }} @endif">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                    <button type="submit" class="btn btn-primary"><em class="bi bi-pen"></em> Termin eintragen</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        function toggleDiv(toggleType) {
            const el = document.getElementById("cancel");
            if (toggleType === '1') el.style.display="none";
            if (toggleType === '0') el.style.display="block";
            const mem = document.getElementById("memory");
            if (toggleType === '1') mem.style.display="block";
            if (toggleType === '0') mem.style.display="none";
            const mem_email = document.getElementById("memory-email");
            if (toggleType === '1') mem_email.style.display="block";
            if (toggleType === '0') mem_email.style.display="none";
        }
    </script>
@endpush

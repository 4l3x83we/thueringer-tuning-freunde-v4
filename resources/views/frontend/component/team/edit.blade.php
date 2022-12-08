<!-- Modal -->
<div class="modal fade" id="teamEditModal" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1" aria-labelledby="teamEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="{{ route('frontend.team.update', $team->slug) }}" method="POST" enctype="multipart/form-data" id="teamEdit">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="teamEditModalLabel">Änderungen am Profil von {{ $team->title }} vornehmen.</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('frontend.component.team.forms.edit')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schliessen</button>
                    <button type="submit" class="btn btn-primary">Änderungen speichern</button>
                </div>
            </div>
        </form>
    </div>
</div>

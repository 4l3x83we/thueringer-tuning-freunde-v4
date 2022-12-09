<div data-bs-toggle="tooltip" data-bs-placement="bottom" title="Löschen" class="d-inline-block">
    @if(auth()->user()->id === $photo->user_id)
        <a class="deletePhoto btn btn-sm btn-danger my-2" data-bs-toggle="modal" data-id="{{ $photo->id }}" data-bs-target="#photoModal">
            <em class="bi bi-trash fw-bold"></em>
        </a>
    @else
        <a class="deletePhoto btn btn-sm btn-outline-danger my-2" data-bs-toggle="modal" data-id="{{ $photo->id }}" data-bs-target="#photoModal">
            <em class="bi bi-trash fw-bold"></em>
        </a>
    @endif
</div>


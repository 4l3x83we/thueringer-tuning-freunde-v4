@csrf
@method('PATCH')
@if(auth()->user()->id === $photo->user_id)
<button type="submit" class="btn btn-sm btn-secondary my-2">
        <em class="bi bi-eye fw-bold"></em>
</button>
@else
    <button type="submit" class="btn btn-sm btn-outline-secondary my-2">
        <em class="bi bi-eye fw-bold"></em>
    </button>
@endif

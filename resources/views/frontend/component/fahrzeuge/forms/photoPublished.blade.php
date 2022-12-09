<form action="{{ route('frontend.fahrzeuge.photoPublished', $fahrzeuge->slug) }}" method="POST" class="d-inline-flex me-2">
    @csrf
    @method('PATCH')
    @foreach($photos as $photo)
        <input type="hidden" name="photosID[]" value="{{ $photo->id }}">
    @endforeach
    <button type="submit" class="btn btn-success btn-sm"><em class="bi bi-images"></em> Fotos freigeben</button>
</form>

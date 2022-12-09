<form action="{{ route('frontend.fahrzeuge.destroy', $fahrzeuge->slug) }}" method="POST" class="d-inline-flex">
    @csrf
    @method('DELETE')
    <input type="hidden" name="albumDirectory" value="{{ $fahrzeuge->album_id }}">
    @foreach($photos as $photo)
        <input type="hidden" name="photos[]" value="{{ $photo->id }}">
    @endforeach
    <button type="submit" class="btn btn-danger btn-sm"><em class="bi bi-trash"></em> Fahrzeug löschen</button>
</form>

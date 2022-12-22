@push('css')
    <style>
        p:last-child {
            margin: 0 !important;
        }
    </style>
@endpush
<tr>
    <td colspan="6" class="text-center align-middle fw-bold {{ $kalender->type->typeColor }}">{{ $kalender->type->type }}</td>
</tr>
<tr>
    <td class="align-top text-center">{{ \Carbon\Carbon::parse($kalender->von)->isoFormat('DD.MM.YYYY HH:mm') }}</td>
    <td class="align-top text-center">{{ \Carbon\Carbon::parse($kalender->bis)->isoFormat('DD.MM.YYYY HH:mm') }}</td>
    <td class="align-top text-center">
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
    @if($kalender->type->typeColor === 'ver')
        <td class="align-top">{!!
            'Wo: ' . explode(', ', $kalender->eigenesFZ)[0] .
            '<br>Straße: ' . explode(', ', $kalender->eigenesFZ)[1] .
            '<br>Ort: ' . explode(', ', $kalender->eigenesFZ)[2] .
            '<br>Beschreibung: ' . nl2br($kalender->description)
            !!}
            @if(!empty($team->assumed->present))
                <strong class="text-success">Du hast bereits zugesagt.</strong>
            @endif
        </td>
    @else
        <td class="align-top">{!! 'Reserviert von: '. $kalender->team->vorname . ' ' . $kalender->team->nachname[0] . '.<br> Beschreibung: ' . $kalender->description !!}</td>
    @endif
    <td class="align-top">{{ \Carbon\Carbon::parse($kalender->published_at)->isoFormat('DD.MM.YYYY') }}</td>
    <td class="align-top">
        @if($kalender->type->typeColor !== 'ver')
            <a href="{{ route('intern.kalender.edit', $kalender->id) }}"><em class="bi bi-pen"></em></a>
        @else
            @hasanyrole('super_admin|admin')
                <a href="{{ route('intern.kalender.edit', $kalender->id) }}"><em class="bi bi-pen"></em></a>
            @endhasanyrole
            @if(!empty($team->assumed->present))
                <a class="ms-2 text-success"><em class="bi bi-check-circle"></em></a>
            @else
                <a data-bs-toggle="modal" data-bs-target="#assumedUpdate" class="ms-2 text-danger" style="cursor: pointer;"><em class="bi bi-x-circle"></em></a>
            @endif
        @endif
    </td>
</tr>



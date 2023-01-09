@extends('layouts.app')

@section('title', 'Zahlungsübersicht')
@section('description'){{ strip_tags(Str::limit('Hier kannst du sehen wer was Bezahlt.'), 150) }}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="internAntrag" id="internAntrag">
        <div class="container-fluid">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-8">
                    <div class=" text-bg-dark shadow internTable">
                        <div class="d-flex justify-content-end mb-3">
                            <a class="links-light-cursor" data-bs-toggle="modal" data-bs-target="#createPaymentTableModal"><em class="bi bi-plus-circle"></em> </a>
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable_zahlung" class="table responsive table-bordered table-hover w-100">
{{--                                @foreach($teams as $team)--}}
                                    <thead>
                                        <tr>
{{--                                            <th colspan="14" class="text-center fw-bold">{{ $jahr->GesamtJahr }}</th>--}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Name</td>
                                            @for($i = 1; $i <= 12; $i++)
{{--                                                <td>{{ Carbon\Carbon::parse('01.'.$i.'.'.$jahr->GesamtJahr)->monthName }}</td>--}}
                                            @endfor
                                            <td>Gesamt</td>
                                        </tr>
                                        @foreach($teams as $team)
                                            <tr>
                                                <td>{{ $team->vorname . ' ' . $team->nachname }}</td>
                                                {{--@foreach($teams->payments as $payments)
                                                    @if($payments->name === $name->Name and $payments->bezahlt === 0 and $payments->jahr === $jahr->GesamtJahr)
                                                        <td class="bg-danger">{{ $payments->zahlung }}</td>
                                                    @elseif($payments->name === $name->Name and $payments->bezahlt === 1 and $payments->jahr === $jahr->GesamtJahr)
                                                        <td class="bg-success">{{ $payments->zahlung }}</td>
                                                    @endif
                                                @endforeach--}}
                                                <td></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
{{--                                @endforeach--}}
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class=" text-bg-dark shadow internTable">
                        <div class="table-responsive">
                            <table id="dataTable_columnFree" class="table responsive table-bordered table-hover w-100">
                                <thead>
                                    <tr>
                                        <th colspan="3" class="text-center fw-bold">Übersicht der Beiträge von jedem Mitglied.</th>
                                    </tr>
                                    <tr>
                                        <th style="min-width: 180px;">Mitglied</th>
                                        <th style="min-width: 120px;">Zahlung</th>
                                        <th>Aktion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(count($teams) > 0)
                                    @foreach($teams as $team)
                                        <tr>
                                            <td>{{ $team->vorname . ' ' . $team->nachname }} @if($team->zahlungsArt === 'wb') (WB) @elseif($team->zahlungsArt === 'mb') (MB) @endif</td>
                                            <td class="text-end align-middle">
                                                @if($team->zahlung >= '100')
                                                    <span class="align-middle text-end text-success">{{ number_format($team->zahlung, '2', ',', '.') . ' €' }} <sup>*</sup></span>
                                                @elseif($team->zahlung >= '50' and $team->zahlung <= '99')
                                                    <span class="align-middle text-end text-info">{{ number_format($team->zahlung, '2', ',', '.') . ' €' }} <sup>*</sup></span>
                                                @elseif($team->zahlung >= '21' and $team->zahlung <= '49')
                                                    <span class="align-middle text-end text-warning">{{ number_format($team->zahlung, '2', ',', '.') . ' €' }} <sup>*</sup></span>
                                                @else
                                                    <span class="align-middle text-end">{{ number_format($team->zahlung, '2', ',', '.') . ' €' }} <sup>*</sup></span>
                                                @endif
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('intern.admin.zahlungen.edit', $team->id) }}"><em class="bi bi-pen"></em></a>
                                                <span class="px-2"></span>
                                                <a href="{{ route('intern.admin.zahlungen.edit-euro', $team->id) }}"><em class="bi bi-currency-euro"></em></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr>
                                    <td></td>
                                    <td class="align-middle text-end fw-bold">{{ number_format($teams->gesamt, '2', ',', '.') . ' €' }}</td>
                                    <td></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="align-middle text-end">Legende:</td>
                                        <td colspan="2">
                                            <div class="d-flex flex-column justify-content-start align-items-start">
                                                <span>Hebebühnen Nutzung</span>
                                                <span class="text-success"><em class="bi bi-asterisk"></em> (unbegrenzt)</span>
                                                <span class="text-info"><em class="bi bi-asterisk"></em> (40h frei, ab 41h a 2,50 €/h)</span>
                                                <span class="text-warning"><em class="bi bi-asterisk"></em> (20h frei, ab 21h a 2,50 €/h)</span>
                                                <span><em class="bi bi-asterisk"></em> (a 5 €/h)</span>
                                                <span>WB = Werkstattbeteiligung</span>
                                                <span>MB = Mitgliedsbeitrag</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="createPaymentTableModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="createPaymentTableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form action="{{ route('intern.admin.zahlungen.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createAlbumModalLabel">Neue Tabellenzeile erstellen für:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-lg-12">
                                @foreach($teams as $team)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="teamID[]" value="{{ $team->id }}" id="teamID-{{ $team->id }}">
                                    <label class="form-check-label" for="teamID-{{ $team->id }}">
                                        {{ $team->vorname . ' ' . $team->nachname }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
                        <button type="submit" class="btn btn-primary">Tabellenzeile erstellen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="module">
        $(document).ready(function () {
            $('#dataTable_columnFree').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": false,
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/de-DE.json"
                },
                "order": [
                    [0, 'ASC'],
                ],
                "columnDefs": [
                    {
                        "orderable": false,
                        "targets": [2]
                    }
                ],
            });
            /*$('#dataTable_zahlung').DataTable({
                /!*"paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "responsive": true,
                "autoWidth": false,*!/
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/de-DE.json"
                },
                /!*"order": [
                    [0, 'ASC'],
                ],*!/
                /!*"columnDefs": [
                    {
                        "orderable": false,
                        "targets": [2]
                    }
                ],*!/
            });*/
        });
    </script>
@endpush

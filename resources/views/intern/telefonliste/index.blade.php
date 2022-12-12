@extends('layouts.app')

@section('title', 'Telefon & Kontaktliste')
@section('description'){{ strip_tags(Str::limit('Hier hast du eine Übersicht der Kontaktmöglichkeiten.'), 150) }}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="telefonliste" id="telefonliste">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="row">
                <div class="col-12 text-bg-dark shadow telefonlisteTable">
                    <div class="table-responsive p-3">
                        <table class="table table-striped table-hover">
                            <tbody>
                                <tr>
                                    <th colspan="4" class="text-end">
                                        <a href="{{ route('intern.pdf.telefonliste', ['download' => 'pdf']) }}" class="btn btn-link print-btn p-0 text-decoration-none d-print-none" style="font-size: 18px;" >Telefon & Kontaktliste als PDF <em class="bi bi-file-pdf"></em></a>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-bg-light">Name</th>
                                    <th class="text-bg-light">Telefon / Mobil</th>
                                    <th class="text-bg-light">E-Mail</th>
                                    <th class="text-bg-light">E-Mail Intern</th>
                                </tr>
                                @foreach($team as $item)
                                    <tr>
                                        <th>@if($item->title != $item->vorname) ({{ $item->title }}) / @endif {{ $item->vorname . ' ' . $item->nachname }}</th>
                                        <th>@if($item->telefon) {{ $item->telefon }} / @endif {{ $item->mobil }}</th>
                                        <th>{{ $item->email }}</th>
                                        <th>{{ $item->emailIntern }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

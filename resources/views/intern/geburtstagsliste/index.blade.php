@extends('layouts.app')

@section('title', 'Geburtstagsliste')
@section('description'){{ strip_tags(Str::limit('Eine Übersicht über die Geburtstage unserer Mitglieder.'), 150) }}@endsection
@section('robots', 'NOINDEX,NOFOLLOW')

@section('content')
    <section class="geburtstagsliste" id="geburtstagsliste">
        <div class="container">

            <div class="section-title">
                <h2>@yield('title')</h2>
                <p>@yield('description')</p>
            </div>

            <div class="row">
                <div class="col-12 text-bg-dark shadow geburtstagslisteTable">
                    <div class="table-responsive p-3">
                        <table class="table table-striped table-hover">
                            <tbody>
                            <tr>
                                <th colspan="3" class="text-center fs-5 text-bg-light">Geburtstrage im {{ \Carbon\Carbon::now()->isoFormat('MMMM YYYY') }}</th>
                            </tr>
                            @foreach($team as $item)
                                @if(\Carbon\Carbon::parse($item->geburtsdatum)->format('d.m') == date('d.m'))
                                    <tr>
                                        <th colspan="3" class="text-center text-uppercase text-danger py-4 fs-4">Alles Gute {{ $item->title }} zum {{ \Carbon\Carbon::parse($item->geburtsdatum)->age . '. Geburtstag' }}</th>
                                    </tr>
                                @else
                                    @if(\Carbon\Carbon::parse($item->geburtsdatum)->format('m') == date('m'))
                                        @if(\Carbon\Carbon::parse($item->geburtsdatum)->format('d') >= date('d'))
                                            <tr>
                                                <th>@if($item->title != $item->vorname) ({{ $item->title }}) / @endif {{ $item->vorname . ' ' . $item->nachname }}</th>
                                                <th>{{ \Carbon\Carbon::parse($item->geburtsdatum)->isoFormat('DD.MM.YYYY') }}</th>
                                                <th>{{ 'wird diesen Monat ' . (\Carbon\Carbon::parse($item->geburtsdatum)->age) + 1 . ' Jahre alt' }}</th>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                            @endforeach
                                <tr>
                                    <th colspan="3" class="text-end">
                                        <a href="{{ route('intern.pdf.geburtstagsliste', ['download' => 'pdf']) }}" class="btn btn-link print-btn p-0 text-decoration-none d-print-none" style="font-size: 18px;">Geburtstagsliste als PDF <em class="bi bi-file-pdf"></em></a>
                                    </th>
                                </tr>
                                <tr>
                                    <th class="text-bg-light">Name</th>
                                    <th class="text-bg-light">Geburtstag</th>
                                    <th class="text-bg-light">Aktuelles Alter</th>
                                </tr>
                                @for($i = 01; $i <= 12; $i++)
                                    @foreach($team as $item)
                                        @if(\Carbon\Carbon::parse($item->geburtsdatum)->isoFormat('MM') == $i)
                                            <tr>
                                                <th>@if($item->title != $item->vorname) ({{ $item->title }}) / @endif {{ $item->vorname . ' ' . $item->nachname }}</th>
                                                <th>{{ \Carbon\Carbon::parse($item->geburtsdatum)->isoFormat('DD.MM.YYYY') }}</th>
                                                <th>{{ \Carbon\Carbon::parse($item->geburtsdatum)->age . ' Jahre' }}</th>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

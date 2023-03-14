@extends('layouts.app')

@section('title', 'Veranstaltungen')
@section('description'){{ strip_tags(Str::limit('Hier kannst du Tuning Treffen sehen.'), 150) }}@endsection

@section('robots', 'INDEX,FOLLOW')

@section('content')
    <!-- ======= Veranstaltungen ======= -->
    <div class="veranstaltungenPage">
        @include('frontend.index.veranstaltungen')
    </div>
@endsection

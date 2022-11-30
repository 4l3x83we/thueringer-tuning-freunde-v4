@extends('layouts.app')

@section('title', 'Kontaktanfrage')
@section('description')
    {{ strip_tags(Str::limit('Hier kannst du uns kontaktieren.'), 150) }}
@endsection
@section('robots', 'INDEX,FOLLOW')

@include('helpers.component.recaptcha')

@section('content')
    <!-- ======= Kontakt ======= -->
    <div class="kontaktPage">
        @include('frontend.component.kontakt')
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Startseite')
@section('description')
    {{ strip_tags(Str::limit('Wir sind ein kleiner Marken offener Tuning Club'), 150) }}
@endsection
@section('robots', 'INDEX,FOLLOW')

@section('hero')
    <!-- ======= Hero Section ======= -->
    @include('frontend.component.hero')
@endsection

@section('content')
    <!-- ======= Über uns ======= -->
    @include('frontend.component.ueber-uns')
    <!-- ======= Team ======= -->

    <!-- ======= Fahrzeuge ======= -->

    <!-- ======= Galerie ======= -->

    <!-- ======= Veranstaltungen ======= -->

    <!-- ======= Kontakt ======= -->
    @include('frontend.component.kontakt')
@endsection

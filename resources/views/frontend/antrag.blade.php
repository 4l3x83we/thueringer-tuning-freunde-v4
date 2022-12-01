@extends('layouts.app')

@section('title', 'Mitgliedsantrag')
@section('description')
    {{ strip_tags(Str::limit('Hier kannst du deinen Mitgliedsantrag einreichen.'), 150) }}
@endsection
@section('robots', 'INDEX,FOLLOW')

@section('content')
    <!-- ======= Antrag ======= -->
    @include('frontend.component.antrag.index')
@endsection

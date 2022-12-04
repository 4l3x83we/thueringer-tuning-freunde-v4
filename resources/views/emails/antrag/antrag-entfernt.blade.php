@extends('emails.layouts.main')

@section('title') Wir wurden verlassen &#128557. @endsection

@section('content')
    <p>Hallo,</p>
    <p>soeben hat uns {{ $antrag->vorname }} verlassen.</p>
    <p>Wir wünschen dir viel Spaß auf deinem weiteren Weg.</p>
    <p>Das Team von Thüringer Tuning Freunde.</p>
@endsection

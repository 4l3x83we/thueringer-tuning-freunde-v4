@extends('emails.layouts.main')

@section('title', 'Kontaktanfrage')

@php
    $location = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$kontakt->ip_adresse));
@endphp

@section('content')
    <table width="100%" border="0">
        <tbody>
        <tr>
            <td style="width: 200px;">Name:</td>
            <td>{{ $kontakt->name }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">E-Mail:</td>
            <td>{{ $kontakt->email }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">Betreff:</td>
            <td>{{ $kontakt->subject }}</td>
        </tr>
        <tr>
            <td style="width: 200px; vertical-align: top;">Nachricht:</td>
            <td>{!! nl2br($kontakt->message) !!}</td>
        </tr>
        <tr>
            <td style="width: 200px; vertical-align: top;">IP-Adresse:</td>
            <td>{!! nl2br($kontakt->ip_adresse) !!} <img src="https://flagsapi.com/{{ $location['geoplugin_countryCode'] }}/shiny/24.png" alt="{{ $location['geoplugin_countryCode'] }}"> {{ $location['geoplugin_countryName'] }}</td>
        </tr>
        </tbody>
    </table>
@endsection

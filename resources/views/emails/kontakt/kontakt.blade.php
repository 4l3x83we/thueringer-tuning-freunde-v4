@extends('emails.layouts.main')

@section('title', 'Kontaktanfrage')

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
            <td>{!! nl2br($kontakt->ip_adresse) !!}</td>
        </tr>
        </tbody>
    </table>
@endsection

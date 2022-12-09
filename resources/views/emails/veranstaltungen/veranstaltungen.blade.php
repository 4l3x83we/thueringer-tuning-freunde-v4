@extends('emails.layouts.main')

@section('title', 'Neue Veranstaltung')

@section('content')
    <table width="100%" border="0">
        <tbody>
        <tr>
            <td style="width: 200px; vertical-align: top;">Veranstaltung:</td>
            <td>
                am {{ \Carbon\Carbon::parse($veranstaltungen->datum_von)->isoFormat('DD.MM.YYYY HH:mm') }}
                bis {{ \Carbon\Carbon::parse($veranstaltungen->datum_bis)->isoFormat('DD.MM.YYYY HH:mm') }}<br><br>
                {{ $veranstaltungen->veranstaltung }}<br>
                {{ $veranstaltungen->veranstaltungsort }}<br>
                {{ $veranstaltungen->veranstalter }}<br>
            </td>
        </tr>
        @if($veranstaltungen->webseite == true or $veranstaltungen->social_fb == true  or $veranstaltungen->social_ig == true or $veranstaltungen->social_tw == true)
            <tr>
                <td style="width: 200px; vertical-align: top;">Kontakt:</td>
                <td>
                    @if($veranstaltungen->webseite)
                        <a href="{{ $veranstaltungen->webseite }}">{{ $veranstaltungen->webseite }}</a><br>
                    @endif
                    @if($veranstaltungen->social_fb)
                        <a href="{{ $veranstaltungen->social_fb }}">{{ $veranstaltungen->social_fb }}</a><br>
                    @endif
                    @if($veranstaltungen->social_ig)
                        <a href="{{ $veranstaltungen->social_ig }}">{{ $veranstaltungen->social_ig }}</a><br>
                    @endif
                    @if($veranstaltungen->social_tw)
                        <a href="{{ $veranstaltungen->social_tw }}">{{ $veranstaltungen->social_tw }}</a><br>
                    @endif
                </td>
            </tr>
        @endif
        <tr>
            <td style="width: 200px; vertical-align: top;">Beschreibung:</td>
            <td>{!! Str::limit($veranstaltungen->description, 250) !!}</td>
        </tr>
        </tbody>
    </table>
@endsection

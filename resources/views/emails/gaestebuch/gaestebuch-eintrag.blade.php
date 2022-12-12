@extends('emails.layouts.main')

@section('title', 'Neuer Gästebucheintrag')

@section('content')
    <table width="100%" border="0">
        <tbody>
        <tr>
            <td style="width: 200px;">Name:</td>
            <td>{{ $gästebuch->name }}</td>
        </tr>
        <tr>
            <td style="width: 200px;">E-Mail:</td>
            <td>{{ $gästebuch->email }}</td>
        </tr>
        @if($gästebuch->website == true)
            <tr>
                <td style="width: 200px;">Webseite:</td>
                <td>{{ $gästebuch->website }}</td>
            </tr>
        @endif
        @if($gästebuch->facebook == true or $gästebuch->tiktok == true or $gästebuch->instagram == true)
            <tr style="margin-bottom: 20px;">
                <td style="width: 200px;">Social Media:</td>
                <td>
                    @if($gästebuch->facebook == true)
                        <a href="https://www.facebook.com/{{ $gästebuch->facebook }}"><i class="icofont-facebook"></i> Facebook</a> |
                    @endif
                    @if($gästebuch->tiktok == true)
                        <a href="https://tiktok.com/{{ $gästebuch->tiktok }}"><i class="icofont-tiktok"></i> TikTok</a> |
                    @endif
                    @if($gästebuch->instagram == true)
                        <a href="https://www.instagram.com/{{ $gästebuch->instagram }}/"><i class="icofont-instagram"></i> Instagram</a>
                    @endif
                </td>
            </tr>
        @endif
        <tr>
            <td style="width: 200px;">Eintrag:</td>
            <td>{!! $gästebuch->message !!}</td>
        </tr>
        </tbody>
    </table>
@endsection

@extends('emails.layouts.main')

@section('title', 'Versammlung')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.2/font/bootstrap-icons.min.css">
@endpush

@section('content')
    <p>Hallo {{ $kalenders->vorname }},<br>
    wir möchten dich nochmal an unsere Versammlung erinnern.</p>
    <table width="100%" border="0">
        <tbody>
            <tr>
                <td style="width: 200px;">Wann:</td>
                <td>{{ 'am ' . \Carbon\Carbon::parse($kalenders->von)->isoFormat('DD.MM.YYYY') . ' von ' . \Carbon\Carbon::parse($kalenders->von)->isoFormat('HH:mm') . ' - ' . \Carbon\Carbon::parse($kalenders->bis)->isoFormat('HH:mm') }}</td>
            </tr>
            <tr style="vertical-align: top;">
                <td style="width: 200px;">Wo:</td>
                <td>{!! $kalenders->eigenesFZ !!} <br>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt" viewBox="0 0 16 16">
                        <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A31.493 31.493 0 0 1 8 14.58a31.481 31.481 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94zM8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10z"/>
                        <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg> <a href="https://maps.google.com/maps?saddr=&daddr={{ str_replace(",", "", str_replace(" ", "+", $kalenders->adresse)) }}" target="_blank">Hier gehts zur Routenplanung.</a>
                </td>
            </tr>
            <tr><td colspan="2">&nbsp;</td></tr>
            <tr>
                <td colspan="2">{!! nl2br($kalenders->description) !!} </td>
            </tr>
        </tbody>
    </table>
@endsection

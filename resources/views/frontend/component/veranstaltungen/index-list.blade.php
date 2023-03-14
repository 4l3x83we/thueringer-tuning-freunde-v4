<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Veranstaltungen</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        @media dompdf {
            * {
                line-height: 1;
            }
        }
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        table tr th {
            font-size: 14px;
        }
        table tr td {
            font-size: 10px;
        }
    </style>
</head>
<body>
<h2 class="mb-3">Veranstaltungsübersicht <span style="font-size: 14px;">{{ env('TTF_URL') }}</span></h2>
<div class="text-success mb-3">Grün markiert: Besuchen wir</div>
<table class="table table-striped">
    <thead>
    <tr>
        <th colspan="2">Datum</th>
        <th>Treffen</th>
        <th>Veranstalter</th>
        <th>Ort</th>
        <th>Quelle</th>
        <th>Eintritt</th>
    </tr>
    </thead>
    <tbody>
    @foreach(\App\Models\Frontend\Veranstaltungen\Veranstaltungen::sort_by_month() as $month => $veranstaltungens)
        <tr>
            <td colspan="7" style="font-size: 12px; font-weight: bold;" class="text-center">{{ $month }}</td>
        </tr>
            @foreach($veranstaltungens as $item)
                @if($item->anwesend === 1)
                <tr class="text-success fw-bold">
                    <td>{{ App\Models\Frontend\Veranstaltungen\Veranstaltungen::veranstaltungenDate($item->datum_von, $item->datum_bis)['von'] }}</td>
                    <td>{{ App\Models\Frontend\Veranstaltungen\Veranstaltungen::veranstaltungenDate($item->datum_von, $item->datum_bis)['bis'] }}</td>
                    <td>{{ $item->veranstaltung }}</td>
                    <td>{{ $item->veranstalter }}</td>
                    <td>{{ $item->veranstaltungsort }}</td>
                    <td>{{ $item->quelle }}</td>
                    <td>@if($item->eintritt === 'link in der Beschreibung' or $item->eintritt === 'siehe Beschreibung' or empty($item->eintritt)) Kein Eintrittspreis bekannt. @else {{ $item->eintritt }} @endif</td>
                </tr>
                @else
                <tr>
                    <td>{{ App\Models\Frontend\Veranstaltungen\Veranstaltungen::veranstaltungenDate($item->datum_von, $item->datum_bis)['von'] }}</td>
                    <td>{{ App\Models\Frontend\Veranstaltungen\Veranstaltungen::veranstaltungenDate($item->datum_von, $item->datum_bis)['bis'] }}</td>
                    <td>{{ $item->veranstaltung }}</td>
                    <td>{{ $item->veranstalter }}</td>
                    <td>{{ $item->veranstaltungsort }}</td>
                    <td>{{ $item->quelle }}</td>
                    <td>@if($item->eintritt === 'link in der Beschreibung' or $item->eintritt === 'siehe Beschreibung' or empty($item->eintritt)) Kein Eintrittspreis bekannt. @else {{ $item->eintritt }} @endif</td>
                </tr>
                @endif
            @endforeach
    @endforeach
    </tbody>
</table>
</body>
</html>

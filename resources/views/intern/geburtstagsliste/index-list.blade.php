<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Geburtstagsliste</title>
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
        table tr td {
            font-size: 10px;
        }
    </style>
</head>
<body>
<h2 class="mb-3">Geburtstagsliste</h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Geburtstag</th>
        <th>Aktuelles Alter</th>
    </tr>
    </thead>
    <tbody>
    @for($i = 01; $i <= 12; $i++)
        @foreach($team as $item)
            @if(\Carbon\Carbon::parse($item->geburtsdatum)->isoFormat('MM') == $i)
                <tr>
                    <th>@if($item->title != $item->vorname) ({{ $item->title }}) / @endif {{ $item->vorname . ' ' . $item->nachname }}</th>
                    <th>{{ \Carbon\Carbon::parse($item->geburtsdatum)->isoFormat('DD.MM.YYYY') }}</th>
                    <th>{{ \Carbon\Carbon::parse($item->geburtsdatum)->age . ' Jahre' }}</th>
                </tr>
            @endif
        @endforeach
    @endfor
    </tbody>
</table>
</body>
</html>

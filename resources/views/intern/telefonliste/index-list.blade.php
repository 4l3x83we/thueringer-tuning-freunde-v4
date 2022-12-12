<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Telefon & Kontaktliste</title>
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
<h2 class="mb-3">Telefon & Kontaktliste</h2>
<table class="table table-striped">
    <thead>
    <tr>
        <th>Name</th>
        <th>Telefon / Mobil</th>
        <th>E-Mail</th>
        <th>E-Mail Intern</th>
    </tr>
    </thead>
    <tbody>
    @foreach($team as $item)
        <tr>
            <th>@if($item->title != $item->vorname) ({{ $item->title }}) / @endif {{ $item->vorname . ' ' . $item->nachname }}</th>
            <th>@if($item->telefon) {{ $item->telefon }} / @endif {{ $item->mobil }}</th>
            <th>{{ $item->email }}</th>
            <th>{{ $item->emailIntern }}</th>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

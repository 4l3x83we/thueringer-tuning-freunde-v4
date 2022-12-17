<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=gluten:100,200,300,400,500,600,700,800,900|nunito:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i|racing-sans-one:400" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" rel="stylesheet">
    @stack('css')
    <style>
        body, html {
            font-family: "Nunito", sans-serif;
            font-size: 16px;
            color: #cccccc;
        }
        a {
            color: #ff4400;
            text-decoration: none;
        }
        a:hover {
            color: #ff5619;
            text-decoration: underline;
        }
        body, table, td, a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }
        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        img {
            -ms-interpolation-mode: bicubic;
        }
        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }
        table {
            border-collapse: collapse !important;
        }
        body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        .btn {
            border-radius: 4px;
            display:inline-block;
            cursor:pointer;
            color:#ffffff;
            font-family: "Arial", sans-serif;
            font-size:14px;
            padding:4px 8px;
            text-decoration:none;
        }
        .btn-primary {
            background: #0d6dfd;
            border:1px solid #0d6dfd;
        }
        .btn-primary:hover {
            background: #0b5ed7;
            border:1px solid #0a58ca;
        }
        .btn-primary:active {
            position:relative;
            top:1px;
        }
        .btn-danger {
            background: #dc3545;
            border:1px solid #dc3545;
        }
        .btn-danger:hover {
            background: #bb2d3b;
            border:1px solid #b02a37;
        }
        .btn-danger:active {
            position:relative;
            top:1px;
        }
        @media screen and (max-width: 600px) {
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }
    </style>
</head>
<body style="background-color: #121212; margin: 0 !important; padding: 0 !important;">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <!-- Logo -->
    <tr>
        <td bgcolor="#292929" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 95%;">
                <tr>
                    <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#292929" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 95%;">
                <td bgcolor="#3d3d3d" align="center" valign="top"
                    style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #cccccc; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                    <h1 style="font-size: 100%; font-weight: 400; margin: 2px;">@yield('title')</h1>
                </td>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#121212" align="center">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 95%;">
                <td bgcolor="#3d3d3d" align="left" style="padding: 20px 30px 40px 30px; color: #cccccc; font-size: 16px !important; font-weight: 400; line-height: 25px; border-radius: 0 0 4px 4px">
                    @yield('content')
                </td>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#121212" align="center" style="padding: 30px 0px 0px 0px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 95%;">
                <tr>
                    <td bgcolor="#292929" align="center"
                        style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #cccccc; font-size: 16px !important; font-weight: 400; line-height: 25px;">
                        <ul style="padding-left: 0; list-style: none;">
                            <li>{{ env('TTF_NAME') }}</li>
                            <li>{{ env('TTF_STRASSE') }}</li>
                            <li>{{ env('TTF_ORT') }}</li>
                            <li>&nbsp;</li>
                            <li>Telefon: {{ env('TTF_TELEFON') }}</li>
                            <li>E-Mail: {{ env('TTF_EMAIL') }}</li>
                        </ul>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td bgcolor="#121212" align="center" style="padding: 0px 10px 0px 10px;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 95%;">
                <tr>
                    <td bgcolor="#121212" align="left"
                        style="padding: 0px 30px 30px 30px; color: #cccccc; font-size: 14px; font-weight: 400; line-height: 18px;">
                        <br>
                        <p style="margin: 0; text-align: center; font-size: 10px;">&copy; {{ env('TTF_NAME') }}. Alle Rechte vorbehalten.</p>
                    </td>
                </tr>
            </table>

        </td>
    </tr>

</table>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.bundle.min.js"></script>
@stack('js')
</body>
</html>

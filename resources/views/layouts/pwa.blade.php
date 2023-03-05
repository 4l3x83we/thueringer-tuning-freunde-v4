<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    @laravelPWA
    <!-- Styles -->
    <style>
        body {
            padding: 8%;
            font-family: Verdana, sans-serif;
            text-align: center;
            margin-top: 1%;
            line-height: 30px;
            background-color: #121212;
        }

        .txtblue {
            font-size: 16px;
            font-weight: 400;
            color: #cccccc;
        }

        .txtwhite {
            font-size: 16px;
            color: #FFFFFF;
        }

        .txtyellow {
            font-size: 16px;
            color: #ff4400;
        }

        .imgcenter {
            width: 20%;
        }
    </style>
</head>
<body class="body">
    @yield('content')
</body>
</html>

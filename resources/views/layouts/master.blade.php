<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>upimgs.net</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {!! Html::favicon('images/favicon.ico') !!}

    <!-- CSS -->
    {!! Html::style('css/app.css') !!}

    <!-- Scripts -->
    {!! Html::script('https://code.jquery.com/jquery-2.2.3.min.js') !!}
    {!! Html::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') !!}
</head>
<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse">
        <div class="container">

            <div class="navbar-header">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ URL::to('/') }}">
                    upimgs.net<!--{!! Html::image('images/mono-logo.png', 'logo', ['style' => 'height: 32px;']) !!}-->
                </a>
            </div>
        </div>

    </nav>

    <!-- Content -->
    <div class="container">
        <div class="row">
            @yield('menu')
            @yield('page')
        </div>
    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/chosen/chosen.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/trumbowyg/dist/ui/trumbowyg.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') | Admin panel</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('admin.template.partials.nav')
    {{-- contenido / errores --}}
    <div class="container">
        <div class="row">
            <div class="col-md-@yield('col', '12') col-md-offset-@yield('offset', '0')">
                <div class="panel panel-default">
                    <div class="panel-heading">@yield('title', 'bienvenido')</div>
                    <div class="panel-body">
                        @include('admin.template.partials.errors')
                        @include('flash::message')
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('plugins/jquery/jquery-3.2.1.min.js') }}" ></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('plugins/chosen/chosen.jquery.js') }}" ></script>
<script src="{{ asset('plugins/trumbowyg/dist/trumbowyg.min.js') }}"></script>
@yield('js')
</body>
</html>
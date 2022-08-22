<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7989db13d4.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/estilo-basico.css') }}">
    <script src="{{ asset('js/scripts.js') }}"></script>
    <title>GeradorOS - @yield('titulo')</title>
</head>
<body>
    @include('app.layouts._partials.topo')
    @yield('conteudo')
</body>
</html>

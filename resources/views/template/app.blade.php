<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="{{ url('bootstrap4/css/bootstrap.css') }}">
</head>
<body>
<div class="container" id="app">
    @yield('corpo')
</div>

</body>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="{{ url('bootstrap4/js/bootstrap.js') }}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ url('vueCustom.js') }}"></script>

@yield('jspage')
</html>
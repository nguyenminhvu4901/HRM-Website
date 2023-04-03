<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href='{{ asset('clients/css/bootstrap.min.css') }}'>
    <link rel="stylesheet" href='{{ asset('clients/css/style.css') }}'>
    <style>
        @yield('css');
    </style>
</head>

<body>
    <header>
        @include('clients.blocks.header')
    </header>
    <main>
        <aside>
            @yield('sidebar')
            @include('clients.blocks.sidebar')
        @show
    </aside>
    <div class="content">
        @yield('content')
    </div>

</main>
<footer>
    @include('clients.blocks.footer')
</footer>
<script src='{{ asset('clients/js/bootstrap.min.js') }}'></script>
<script src='{{ asset('clients/css/custom.js') }}'></script>
<script type="text/javascript">
    @yield('js');
</script>

</body>

</html>

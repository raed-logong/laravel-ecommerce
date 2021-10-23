<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @if(!auth()->guest())
            <script>
                window.Laravel.userId = <?php echo auth()->user()->id; ?>
            </script>
        @endif

        <title>PolyCommerce | @yield('title', '')</title>

        <link href="public/poly.png" rel="SHORTCUT ICON" />

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat%7CRoboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">


        @yield('extra-css')
    </head>


<body class="@yield('body-class', '')">
    <div >
        @include('partials.nav')

        @yield('content')

        @include('partials.footer')
    </div>
    @yield('extra-js')

</body>
</html>

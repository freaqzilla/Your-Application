<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

            <title>{!! COMPANY_NAME !!}</title>

        <!-- Theme style -->
        <link rel="stylesheet" href="/css/custom_styles.css?rnd{!! time() !!}">
        <link rel="stylesheet" href="/js/jquery.js">


        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
                <div class="top-right links">
                        <a href="{{ url('/home') }}">Home</a>
                </div>
        </div>
        <div class="content-wrapper">
            <section class="content">
                @yield('content')
            </section>
        </div>
    </body>
</html>

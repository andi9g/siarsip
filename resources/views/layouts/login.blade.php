<!DOCTYPE html>
<html>
    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8"/>
        <title>LOGIN</title>

        <!-- Site favicon -->
        {{-- <link
            rel="apple-touch-icon"
            sizes="180x180"
            href="vendors/images/apple-touch-icon.png"/>
        <link
            rel="icon"
            type="image/png"
            sizes="32x32"
            href="vendors/images/favicon-32x32.png"/>
        <link
            rel="icon"
            type="image/png"
            sizes="16x16"
            href="vendors/images/favicon-16x16.png"/> --}}

        <!-- Mobile Specific Metas -->
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, maximum-scale=1"/>

        @include('layouts.header')


    </head>
    <body class="login-page">

        <div
            class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-7">
                        <img src="vendors/images/login-page-img.png" alt=""/>
                    </div>
                    <div class="col-md-6 col-lg-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
        @include('sweetalert::alert')

        <!-- End Google Tag Manager (noscript) -->
    </body>
</html>

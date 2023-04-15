<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>API {{ env('APP_NAME') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            html, body {
                height: 100%;
                margin: 0;
            }
            pre {
                font-family: SFMono-Regular,Consolas,Liberation Mono,Menlo,monospace;
                clear: both;
                color: #fff;
                background: #1b1b1b;
                padding: 20px;
                tab-size: 2;
                word-break: normal;
                hyphens: none;
                position: relative;
                line-height: 28px;
                border-radius: 8px;
                overflow: hidden;
                min-width: calc(80vw - 20vw);
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="container-fluid h-100">
            <div class="h-100">
                <img src="{{ asset('assets/img/logo-devs.png') }}" class="p-5" width="400" alt="Laravel 8 API Server Logo">

                <div class="d-flex flex-lg-row flex-column justify-content-around align-items-center">
                    <div class=" p-5">
                        <h3>{{ env('APP_NAME') }} · API v{{ env('APP_VERSION') }}</h3>
                        <p>API Oficial de {{ env('APP_NAME') }} </p>
<pre>"settings": {
    "app_name": "{{ env('APP_NAME') }}",
    "app_email": "{{ env('MAIL_FROM_ADDRESS') }}",
    "app_version": "{{ env('APP_VERSION' )}}",
    "app_url": "{{ env('APP_URL') }}"
}</pre>
<small>Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</small>
                    </div>
                    <div class="">
                        <img src="{{ asset('assets/img/mockup.png') }}" alt="API Developers" width="400px">
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>

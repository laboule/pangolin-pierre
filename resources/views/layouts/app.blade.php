<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="{{ asset('css/app.css').'?'.uniqid() }}" rel="stylesheet">
        <link href="{{ asset('css/ui.css').'?'.uniqid() }}" rel="stylesheet">

        <title>Les rêves du pangolin</title>
    </head>
    <body class="page_{{ Route::currentRouteName() }}">
        <div class="header-bar">
            <a href="javascript:history.back()">
                <img src="img/btn_back.svg" alt="" style="float:left;" class="back"/>
            </a>

            <div class="app-about">
               <div class="text-wrapper">
                    @lang("Description du projet")
                </div>

                <a href="#" class="read-more"></a>
            </div>
        </div>
        

        <div id="app-wrapper">
            @yield('content')
        </div>

        <script
            src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
            crossorigin="anonymous"></script>
        <script src="{{ asset('js/webaudiorecorder/WebAudioRecorder.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

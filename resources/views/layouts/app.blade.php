<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('css/app.css').'?'.uniqid() }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap" rel="stylesheet">


        <meta property="og:url"                content="https://lesrevesdupangolin.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="Les rêves du Pangolin" />
        <meta property="og:description"        content="Et si on écoutait des rêves" />
        <meta property="og:image"              content="https://lesrevesdupangolin.com/img/19iht-btnumbers19A-facebookJumbo-v2.jpg" />

        <title>Les rêves du pangolin</title>

        <script>
            window.global_public_data = {
                dream_audio_format: '{{ \App\Dream::DREAM_AUDIO_FORMAT }}',
                dream_max_length: {{ \App\Dream::DREAM_AUDIO_MAX_DURATION }}
            };
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset('js/webaudiorecorder/WebAudioRecorder.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    </head>
    <body data-appurl="{{env('APP_URL')}}">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center my-4">
                <div class="col-12 col-sm-10 col-md-8 col-xl-6 col-xxl-5 d-flex flex-row justify-content-between">
                <div>
                <a href="javascript:history.back()" class="button {{Route::currentRouteName() === "welcome" ? "d-none" : ""}}">
                    <img src="/img/btn_back.svg" alt="retour" width="16" height="30"/>
                </a>
                </div>

                <div class="app-about">
                   <div class="custom-modal text-wrapper">
                    <div class="button d-flex justify-content-end mb-5 mr-2" id="close-info">
                        <img src="/img/close.svg" alt="close" width="29"/>
                    </div>
                        @lang("Description du projet")
                    </div>

                    <a href="#" class="read-more" class="button">
                        <img src="/img/info.svg" alt="informations" height="35" />
                    </a>
                </div>
            </div>
            </div>

            @yield('content')
        </div>


    </body>
</html>

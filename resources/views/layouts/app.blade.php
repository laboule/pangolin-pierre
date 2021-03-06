<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="title" content="Les rêves du Pangolin" />
    <meta name="description" content="Et si on se parlait à travers nos rêves? Les rêves du Pangolin est une invitation à ouvrir un dialogue onirique pour porter d’autres voix face à la pandémie, à se relier en déconfinant nos songes." />
    <link href="{{ asset('css/app.css').'?'.uniqid() }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta property="og:url" content="https://lesrevesdupangolin.com" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Les rêves du Pangolin" />
    <meta property="og:description" content="Et si on se parlait à travers nos rêves? Les rêves du Pangolin est une invitation à ouvrir un dialogue onirique pour porter d’autres voix face à la pandémie, à se relier en déconfinant nos songes." />
    <meta property="og:image" content="https://lesrevesdupangolin.com/img/les-reves-du-pangolin-fb.png" />
    <meta name="twitter:title" content="Les rêves du Pangolin">
    <meta name="twitter:description" content="Et si on se parlait à travers nos rêves? Les rêves du Pangolin est une invitation à ouvrir un dialogue onirique pour porter d’autres voix face à la pandémie, à se relier en déconfinant nos songes.">
    <meta name="twitter:image" content="https://lesrevesdupangolin.com/img/les-reves-du-pangolin-twitter.png">
    <meta name="twitter:card" content="summary_large_image">
    <title>Les rêves du pangolin</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-T3S7XD7YCV"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() { dataLayer.push(arguments); }
    gtag('js', new Date());

    gtag('config', 'G-T3S7XD7YCV');

    </script>
    <script>
    window.global_public_data = {
        dream_audio_format: '{{ \App\Dream::DREAM_AUDIO_FORMAT }}',
        dream_max_length: '{{\ App\ Dream::DREAM_AUDIO_MAX_DURATION }}'
    };

    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('js/webaudiorecorder/WebAudioRecorder.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body data-appurl="{{env('APP_URL')}}">
    <div class="container-fluid">
        <div class="d-flex flex-column justify-content-between h-100">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-md-6 d-flex flex-row justify-content-between header">
                    <div>
                        <a href="{{route('welcome')}}" class="button {{Route::currentRouteName() === "welcome" ? "d-none" : ""}}">
                            <img src="/img/btn_back.svg" alt="retour" width="16" height="30" />
                        </a>
                    </div>
                    <div class="app-about">
                        <div class="custom-modal modal-info">
                            <div class="layer">
                            </div>
                            <div class="modal-card text-wrapper">
                                <div class="button d-flex justify-content-end close-modal-button" id="close-info">
                                    <img src="/img/close.svg" alt="close" width="29" />
                                </div>
                                @lang("Description du projet")
                            </div>
                        </div>
                        <a href="#" class="read-more" class="button">
                            <img src="/img/info.svg" alt="informations" height="35" />
                        </a>
                    </div>
                </div>
            </div>
            @yield('content')
        </div>
    </div>
</body>

</html>

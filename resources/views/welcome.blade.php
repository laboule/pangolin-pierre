@extends('layouts.app')
<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap" rel="stylesheet">
<meta property="og:url"                content="http://lesrevesdupangolin.com" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="Les rêves du Pangolin" />
<meta property="og:description"        content="Et si on écoutait des rêves" />
<meta property="og:image"              content="http://lesrevesdupangolin.com/img/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
@section('content')

    <h1 class="page-title">
        @lang("Les rêves du pangolin")
    </h1>

    <div class="home-interaction-block listen">
       <div class="player">
            <div class="audio-control-wrapper player">
                <button id="start_playing" class="audio-control play">Start playing</button>
                <button id="stop_playing" class="audio-control stop">Stop playing</button>

                <div class="native-audio-el-container">
                    <div>
                        <audio controls src="{{ $dream->get_recording_file_url('mp3') }}"></audio>
                    </div>
                </div>
            </div>
        </div>
        <div class="text play-dream">
                @lang("Écouter un rêve")

            <span class="dream-meta user_name play">{{ $dream->user_name }}, 
                @lang('dream user age', ["age" => $dream->user_age]), 
                {{ $dream->user_city }}, 
                @if( $dream->dream_date )
                    @lang('dream date', ["date" => $dream->dream_date->format('j F Y')])
                @endif
            </span>
        </div>

        
    </div>
    
    <div class="logo_revespango"></div>
   
    <div class="home-interaction-block record">
       

        <div class="picto">
            <a href="{{ action('AppController@record_dream') }}">
                <img src="/img/rec.png" width="102" height="52" alt=""/>
            </a>
        </div>
         <div class="text">
            <p>
               @lang("Déposer un rêve")
            </p>
        </div>
    </div>

@endsection
@extends('layouts.app')

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

        <a href="{{ route('welcome') }}" class="play-another-dream">
            @lang('Écouter un autre rêve')
        </a>
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
@extends('layouts.app')

@section('content')
    <h1 class="page-title">
        @lang("La chambre d'écho de nos rêves confinés")
    </h1>

    <div class="app-about">
        <div class="text-wrapper">
            @lang("Description du projet")
        </div>

        <a href="#" class="read-more" 
            data-closed-text="@lang("Lire plus")"
            data-opened-text="@lang("Lire moins")"
            >
            @lang("Lire plus")
        </a>
    </div>

    <div class="home-interaction-block listen">
        <div class="text">
            <a href="#" class="play-dream">
                @lang("Écouter un rêve")
            </a>

            <span class="dream-meta user_name">{{ $dream->user_name }}</span>
            <span class="dream-meta user_age_and_city">
                @lang('dream user age', ["age" => $dream->user_age]), 
                {{ $dream->user_city }}
            </span>
            @if( $dream->dream_date )
                <span class="dream-meta dream_date">
                    @lang('dream date', ["date" => $dream->dream_date->format('j F Y')])
                </span>
            @endif
        </div>

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
    </div>

    <div class="home-interaction-block record">
        <div class="text">
            <a href="{{ action('AppController@record_dream') }}">
                @lang("Déposer un rêve")
            </a>

            <p>
                @lang("Dépot description")
            </p>
        </div>

        <div class="picto">
            <a href="{{ action('AppController@record_dream') }}">
                PICTO
            </a>
        </div>
    </div>

@endsection
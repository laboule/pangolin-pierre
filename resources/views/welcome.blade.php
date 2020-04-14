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
        </div>

        <div class="player">
            PLAYER
        </div>
    </div>

    <div class="home-interaction-block record">
        <div class="text">
            <a href="#">
                @lang("Déposer un rêve")
            </a>

            <p>
                @lang("Dépot description")
            </p>
        </div>
    </div>

@endsection
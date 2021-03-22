@extends('layouts.app')
@section('content')
<div class="listen-container" data-dream="{{$dream ?? ''}}" data-autoplay="{{$autoplay}}">
    <div class="row d-flex justify-content-center">
        <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-row justify-content-start" style="height: 155px;">
            <img class="button" id="listen-button" src="img/listen-dream-button.svg" alt="Ecouter un rêve"/>
            <div id="listen-player">
                <div id="name" class="player-title text-h1" style="margin-bottom: 8px;">Anthony</div>
                <div class="player-content d-flex align-items-center">
                    <img src="img/16.svg" id="nsfw" alt="16 +" width="19" height="19" class="mr-1" />
                    <span id="city">Paris</span>, <span id="date" class="ml-1">Avril 2020</span>
                </div>
                <div class="progress-container mt-3">
                    <div class="total-bar"></div>
                    <div class="bar"></div>
                </div>
                <div class="mt-4">
                    <img src="img/stop.svg" id="stop" alt="stop" height="32" class="button mr-4" />
                    <img src="img/play.svg" id="play" alt="play" height="40" class="button mr-4" />
                    <img src="img/next.svg" alt="next" id="next" class="button" />
                </div>
                <audio class="d-none" id="audio" muted controls src=""></audio>
            </div>
        </div>
    </div>
    <div class="row d-flex justify-content-center banner">
        <div class="col-12 col-sm-9 col-md-5 col-xxl-4">
            <img src="img/dreams-banner.png" class="w-100" />
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <a class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex d-block flex-row justify-content-end button record-dream-button" href="{{route('record_dream')}}" style="height: 155px;">
            <img src="img/record-dream-button.svg" alt="Raconter un rêve" />
        </a>
    </div>
    <div class="custom-modal listen-modal text-center">
        <div class="button d-flex justify-content-end close-modal-button" id="close-listen-modal">
            <img src="/img/close.svg" alt="close" width="29" />
        </div>
        <div id="content">@lang("modalContent1")
        </div>
        <a href="{{route('record_dream')}}" class="text-decoration-none text-white d-block" id="record-dream"><u>@lang("yesRecordDream")</u></a>
        <div id="continue-listen"><u>@lang("noKeepListening")<u></div>
    </div>
</div>
@endsection

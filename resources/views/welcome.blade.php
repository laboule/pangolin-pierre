@extends('layouts.app')

@section('content')
<div class="listen-container">
<div class="row d-flex justify-content-center" data-dream="{{$dream}}">
    <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex flex-row justify-content-start">
        <img class="button" id="listen-button" src="img/listen-dream-button.svg" alt="Ecouter un rêve" width="170" height="156"/>
        <div id="listen-player">
            <div id="name" class="player-title">Anthony</div>
            <div class="player-content d-flex align-items-center">
                           <img src="img/16.svg" id="nsfw" alt="16 +" width="19" height="19" class="mr-1" />
                           <span id="city">Paris</span>, <span id="date" class="ml-1">Avril 2020</span></div>
        <div class="progress-container mt-3">
            <div class="total-bar"></div>
            <div class="bar"></div>
        </div>
        <div class="mt-4">
            <img src="img/stop.svg" id="stop" alt="stop" height="32" class="button mr-4" />
            <img src="img/play.svg" id="play" alt="play" height="40" class="button mr-4" />
            <img src="img/next.svg" alt="next" id="next" class="button" />
        </div>
        <audio class="d-none" id="audio" src=""></audio>
    </div>
</div>
</div>
<div class="row d-flex justify-content-center mt-4">
    <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4">
        <img src="img/dreams-banner.png" class="w-100" />
    </div>
</div>
<div class="row d-flex justify-content-center mt-4">
    <a class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex d-block flex-row justify-content-end button" href="{{route('record_dream')}}">
        <img src="img/record-dream-button.svg" alt="Raconter un rêve" width="170" height="156"/>
    </a>
</div>


<div class="custom-modal listen-modal text-center">
                    <div class="button d-flex justify-content-end mb-4 mr-2" id="close-listen-modal">
                        <img src="/img/close.svg" alt="close" width="29"/>
                    </div>
                    <div class="mb-5">@lang("modalContent1")
                   </div>
                   <a href="{{route('record_dream')}}" class="text-decoration-none text-white d-block mb-5" id="record-dream"><u>@lang("yesRecordDream")</u></a>
                   <div id="continue-listen" class="mb-3"><u>@lang("noKeepListening")<u></div>
</div>
</div>





    <style>


    </style>

    <script>
        $(function() {




});
    </script>

@endsection
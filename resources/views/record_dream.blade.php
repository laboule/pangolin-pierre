@extends('layouts.app')

@section('content')
    <div class="record-step shown" data-step="1">
        <h1 class="page-title">
            @lang("Enregistre ton rêve")
        </h1>

        <div class="page-intro hide-when-recording">
            @lang("Enregistre ton rêve - intro")
        </div>

        <div class="audio-control-wrapper recorder">
            <button id="start_recording" class="audio-control record">Start recording</button>
            <button id="stop_recording" class="audio-control record-red">Stop recording</button>
        </div>
        
        <div class="page-description hide-when-recording">
            @lang("Enregistre ton rêve - description")
        </div>
    </div>

    <div class="record-step" data-step="2">
        <h1 class="page-title">
            @lang("Valide ton rêve")
        </h1>

        <!-- Quick hack to keep the vertical spacing equal between each step -->
        <div class="page-intro" style="visibility: hidden;">
            @lang("Enregistre ton rêve - intro")
        </div>
        <!-- *********** -->

        <div class="audio-control-wrapper player">
            <button id="start_playing" class="audio-control play">Start playing</button>
            <button id="stop_playing" class="audio-control stop">Stop playing</button>

            <div class="native-audio-el-container"></div>
        </div>

        <div class="validate-recording-buttons">
            <button class="start-again">@lang('Recommencer')</button>
            <button class="validate">@lang('Déposer')</button>
        </div>
    </div>
@endsection
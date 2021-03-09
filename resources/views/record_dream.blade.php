@extends('layouts.app')

@section('content')
<div class="record-container" data-step="1">
    <div class="row d-flex justify-content-center pb-5 step-1">
        <audio class="d-none" id="audio-record" src=""></audio>
        <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center">
            <div class="title">@lang("Raconte un rêve")</div>
            <div class="progress-container mt-3 mb-3">
                <div class="total-bar"></div>
                <div class="bar bar-25"></div>
            </div>
            <div class="description">
                 @lang("Enregistre ton rêve - intro")
            </div>
            <div class="audio-timer"></div>
            <div class="record-buttons-container mb-4">
                <div class="record mb-4 button">
                    <img src="img/rec.svg" alt="record" width="92"/>
                </div>
                <div class="stop mb-4 button">
                    <img src="img/rec-stop.svg" alt="record" width="92"/>
                </div>
                <div class="loading-encoder start">
                    <span class="generic-loader"></span>
                    <span class="label">@lang('recorder - before record loading')</span>
                </div>
                <div class="loading-encoder end">
                    <span class="generic-loader"></span>
                    <span class="label">@lang('recorder - while encoding loading')</span>
                </div>
            </div>
            <div class="record-description">@lang("Enregistre ton rêve - start")</div>
            <div class="stop-description">@lang("Enregistre ton rêve - stop")</div>
        </div>
    </div>
    <div class="row d-flex justify-content-center pb-5 step-2">
        <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center">
            <div class="title">@lang("Valide ton rêve")</div>
            <div class="progress-container mt-3 mb-3">
                <div class="total-bar"></div>
                <div class="bar bar-50"></div>
            </div>
            <div class="audio-timer"></div>
            <div>
                <div>
                <img src="img/rec-play.svg" />
                </div>


            </div>
        </div>
    </div>
</div>

<script>
$(function() {




});
</script>

@endsection
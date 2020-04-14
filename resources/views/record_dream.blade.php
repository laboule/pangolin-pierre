@extends('layouts.app')

@section('content')
    <h1 class="page-title">
        @lang("Enregistre ton rêve")
    </h1>

    <div class="page-intro">
        @lang("Enregistre ton rêve - intro")
    </div>

    <div class="recorder-wrapper">
        <button id="start_recording">Start recording</button>
        <button id="stop_recording">Stop recording</button>
    </div>

    <div class="recorder-result">

    </div>
    
    <div class="page-description">
        @lang("Enregistre ton rêve - description")
    </div>
@endsection
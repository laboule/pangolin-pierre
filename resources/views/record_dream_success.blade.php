@extends('layouts.app')
<link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;700&display=swap" rel="stylesheet">

@section('content')
    <h1 class="page-title">
        @lang("Enregistre ton rêve - Succès")
    </h1>

    <div class="thanks-container">
        <strong>@lang('Merci')</strong>

        <p>
            @lang('Merci - description')
        </p>
    </div>

    <div class="thanks-links">
        <!--<a href="{{ action('AppController@record_dream') }}" class="record-another-dream">-->
        <a href="http://lesrevesdupangolin.com" class="record-another-dream">
            @lang('Merci - Enregistre un autre rêve')
        </a>
    </div>

@endsection
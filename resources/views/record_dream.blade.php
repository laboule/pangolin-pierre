@extends('layouts.app')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Barlow">

@section('content') 
    
    <div class="header-bar">
        <a href="https://lesrevesdupangolin.com/">
            <img src="img/btn_back.svg" alt="" style="float:left;"/>
        </a>
    </div>
           
           <img src="/img/rec.png" width="102" height="52" alt="" style="display: block; margin:10px auto 20px auto" />
<div class="record-intro">@lang("Enregistre ton rêve - intro")</div>
            
    <div class="record-step shown" data-step="1">
        <h1 class="page-title">
            @lang("Enregistre ton rêve")
        </h1>

        <div class="page-intro">
           
            <span class="hide-when-recording">
            @lang("Enregistre ton rêve - start")</span>
        </div>

        <div class="audio-control-wrapper recorder">
            <button id="start_recording" class="audio-control record">Start recording</button>
            <button id="stop_recording" class="audio-control record-red">Stop recording</button>

           
              
            <div class="audio-timer">
                00:00
            </div>

            <div class="audio-control-loader loading-encoder">
                <span class="generic-loader"></span>
                <span class="label">@lang('recorder - before record loading')</span>
            </div>

            <div class="audio-control-loader encoding-recording">
                <span class="generic-loader"></span>
                <span class="label">@lang('recorder - while encoding loading')</span>
            </div>
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
            <button id="start_playing" class="audio-control play2">Start playing</button>
            <button id="stop_playing" class="audio-control stop2">Stop playing</button>

            <div class="native-audio-el-container"></div>
        </div>

        <div class="validate-recording-buttons">
            <button class="start-again">@lang('Recommencer')</button>
            <button class="validate">@lang('Déposer')</button>
        </div>
    </div>

    <div class="record-step" data-step="3">
        <h1 class="page-title">
            @lang("Déposer un rêve - title")
        </h1>

        <form method="post"
            action="{{ action('AppController@store_dream') }}" 
            enctype="multipart/form-data" 
            class="send-dream-form">

            @if ($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @csrf

            <input type="hidden" id="form_audio_data" name="form_audio_data">

            <div class="form-entry">
                <label for="user_name">@lang('form input - user_name')</label>
                <input type="text" name="user_name" id="user_name" maxlength="100" required>
            </div>

            <div class="form-entry">
                <label for="user_age">@lang('form input - user_age')</label>
                <input type="text" name="user_age" id="user_age" maxlength="3" required>
            </div>

            <div class="form-entry">
                <label for="user_city">@lang('form input - user_city')</label>
                <input type="text" name="user_city" id="user_city" maxlength="100" required>
            </div>

            <div class="form-entry">
                <label for="user_country">@lang('form input - user_country')</label>
                <input type="text" name="user_country" id="user_country" maxlength="100" required>
            </div>

            <div class="form-entry">
                <label for="dream_date">@lang('form input - dream_date')</label>
                <input type="date" name="dream_date" id="dream_date">
            </div>

            <div class="form-entry">
                <label for="dream_language">@lang('form input - dream_language')</label>
                <input type="text" name="dream_language" id="dream_language" maxlength="255" required>
            </div>

            <div class="form-entry">
                <label for="user_email">@lang('form input - user_email')</label>
                <input type="text" name="user_email" id="user_email" maxlength="255">
                <small>@lang('form info - user_email')</small>
            </div>

            <div class="form-entry">
                <label for="dream_is_nsfw">
                    <input type="checkbox" name="dream_is_nsfw" id="dream_is_nsfw" value="1">
                    <span class="checkbox-label">@lang('form input - dream_is_nsfw')</span>
                </label>
            </div>

            <div class="form-entry">
                <label for="user_email_optin">
                    <input type="checkbox" name="user_email_optin" id="user_email_optin" value="1">
                    <span class="checkbox-label">@lang('form input - user_email_optin')</span>
                </label>
            </div>

            <div class="form-entry">
                <button type="submit" class="submit">@lang('form input - submit')</button>
            </div>
        </form>
@endsection
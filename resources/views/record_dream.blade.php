@extends('layouts.app')

@section('content')
<div class="record-container" data-step="1">
    <audio class="d-none" id="audio-record" src=""></audio>
<div class="step-1">
    <div class="row d-flex justify-content-center pb-5">
        <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center d-none">
            <div class="title">@lang("Raconte un rêve")</div>
            <div class="progress-container mt-3 mb-4">
                <div class="total-bar"></div>
                <div class="bar bar-25"></div>
            </div>
            <div class="description">
                 @lang("Enregistre ton rêve - intro")
            </div>
            <div class="audio-timer">00:00</div>
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
</div>
<div class="step-2">
    <div class="row d-flex justify-content-center pb-5">
        <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center">
            <div class="title">@lang("Valide ton rêve")</div>
            <div class="progress-container mt-3 mb-4">
                <div class="total-bar"></div>
                <div class="bar bar-50"></div>
            </div>
            <div class="audio-timer mb-5">00:00</div>
            <div class="d-flex flex-column align-items-center">
                <div class="button mb-4">
                    <div id="rec-play">
                        <img src="img/rec-play.svg" width="100"/>
                    </div>
                    <div id="rec-stop">
                        <img src="img/rec-stop2.svg" width="100"/>
                    </div>
                </div>
                <div id="restart" class="button mb-4">
                    <a class="text-decoration-none text-white" href="{{route('record_dream')}}"><u>Recommencer</u></a>
                </div>
                <div id="save-dream" class="button button-save">
                    Enregistrer
                </div>
            </div>
        </div>
    </div>
</div>
<div class="step-3">
    <div class="row d-flex justify-content-center pb-5">
        <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center">
            <div class="title">@lang("Enregistre ton rêve")</div>
            <div class="progress-container mt-3 mb-4">
                <div class="total-bar"></div>
                <div class="bar bar-75"></div>
            </div>

    <form method="post"
          class="send-dream-form">

            <input type="hidden" id="form_audio_data" name="form_audio_data">

            <div class="form-entry">
                <input type="text" name="user_name" id="user_name" maxlength="100"
                placeholder="@lang('form input - user_name')">
            </div>

            <div class="form-entry">
                <input placeholder="@lang('form input - user_city')" type="text" name="user_city" id="user_city" maxlength="100">
            </div>

            <div class="form-entry">
                <input type="text" name="user_country" id="user_country" placeholder="@lang('form input - user_country')" maxlength="100">
            </div>

            <div class="form-entry">
                {{-- <label for="dream_date">@lang('form input - dream_date')</label> --}}
                <input type="text" name="dream_date" id="dream_date" placeholder="@lang('form input - dream_date')">
            </div>

            <div class="form-entry">
                <select name="dream_language" id="dream_language" required>
                    <option value="" disabled selected>@lang('form input - dream_language')</option>
                    <option value="french">Français</option>
                    <option value="english">Anglais</option>
                    <option value="spanish">Espagnol</option>
                </select>
                <div class="error" id="error-lang">@lang('form input - error lang')</div>
            </div>

            <div class="form-entry">
                <input type="email" name="user_email" id="user_email" maxlength="255" placeholder="@lang('form input - user_email')" required>
                <div class="error" id="error-email">@lang('form input - error email')</div>
                <small>@lang('form info - user_email')</small>
            </div>


            <div class="form-entry checkbox-wrapper">
              <input type="checkbox" name="dream_is_nsfw" id="dream_is_nsfw" value="1">
              <label for="dream_is_nsfw">
                @lang('form input - dream_is_nsfw')
              </label>
            </div>

            <div class="form-entry checkbox-wrapper">
              <input type="checkbox" name="user_email_optin" id="user_email_optin" value="1">
              <label for="user_email_optin">
                @lang('form input - user_email_optin')
              </label>
            </div>


            <div class="form-entry">
                <button type="submit" id="submit" class="button button-save">
                    @lang('form input - submit')
                </button>
            </div>
        </form>
    </div>
</div>
</div>
<div class="step-4">
    <div class="row d-flex justify-content-center pb-5">
        <div class="col-12 col-sm-9 col-md-7 col-xl-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center">
            <div class="title">@lang("Rêve enregistré")</div>
            <div class="progress-container mt-3 mb-4">
                <div class="total-bar"></div>
                <div class="bar bar-100"></div>
            </div>
            <div class="text-center w-75 mb-4">
                @lang("Merci - description")
            </div>
            <div class="text-center w-75 mb-4">
                @lang("Merci - description 2")
            </div>
            <div class="w-75 d-flex align-items-center justify-content-around">
                <a href="#" class="button">
                <img src="img/facebook.svg" alt="facebook" height="40" />
                </a>
                <a href="#" class="button">
                <img src="img/instagram.svg" alt="instagram" height="40" />
                </a>
                <a href="#" class="button">
                <img src="img/twitter.svg" alt="twitter" height="40" />
                </a>
            </div>
            <div class="button button-save" style="margin-top: 200px;">
                <a href="{{route('welcome')}}" class="text-decoration-none">@lang("Écouter un rêve")</a>
            </div>
        </div>
    </div>
</div>
</div>

<script>
// window.onbeforeunload = function() {
//             return "Are you sure you want to leave?";
//         };
//
//

$(function() {

})

</script>

<style type="text/css">






</style>

@endsection
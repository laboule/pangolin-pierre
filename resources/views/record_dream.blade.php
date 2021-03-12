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
            <div class="record-buttons-container mb-2">
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
                  <option value="Afrikaans">Afrikaans</option>
                  <option value="Albanian">Albanais</option>
                  <option value="Arabic">Arabique</option>
                  <option value="Armenian">Arménien</option>
                  <option value="Basque">Basque</option>
                  <option value="Bengali">Bengalais</option>
                  <option value="Bulgarian">Bulgare</option>
                  <option value="Catalan">Catalan</option>
                  <option value="Cambodian">Cambodgien</option>
                  <option value="Chinese (Mandarin)">Chinois (Mandarin)</option>
                  <option value="Croatian">Croate</option>
                  <option value="Czech">Tchèque</option>
                  <option value="Danish">Danois</option>
                  <option value="Dutch">Hollandais</option>
                  <option value="English">Anglais</option>
                  <option value="Estonian">Estonien</option>
                  <option value="Fiji">Fidjien</option>
                  <option value="Finnish">Finnois</option>
                  <option value="French">Français</option>
                  <option value="Georgian">Géorgien</option>
                  <option value="German">Allemand</option>
                  <option value="Greek">Grec</option>
                  <option value="Hebrew">Hébreux</option>
                  <option value="Hindi">Hindi</option>
                  <option value="Hungarian">Hongrois</option>
                  <option value="Icelandic">Icelandais</option>
                  <option value="Indonesian">Indonésien</option>
                  <option value="Irish">Irlandais</option>
                  <option value="Italian">Italien</option>
                  <option value="Japanese">Japonais</option>
                  <option value="Javanese">Indonésien</option>
                  <option value="Korean">Coréen</option>
                  <option value="Latin">Latin</option>
                  <option value="Latvian">Latvian</option>
                  <option value="Lithuanian">Letton</option>
                  <option value="Macedonian">Macédonien</option>
                  <option value="Malay">Malais</option>
                  <option value="Mongolian">Mongol</option>
                  <option value="Nepali">Népalais</option>
                  <option value="Norwegian">Norvégien</option>
                  <option value="Persian">Persan</option>
                  <option value="Polish">Polonais</option>
                  <option value="Portuguese">Portugais</option>
                  <option value="Romanian">Roumain</option>
                  <option value="Russian">Russe</option>
                  <option value="Serbian">Serbe</option>
                  <option value="Slovak">Slovaque</option>
                  <option value="Slovenian">Slovénien</option>
                  <option value="Spanish">Espagnol</option>
                  <option value="Swahili">Swahili</option>
                  <option value="Swedish ">Suédois </option>
                  <option value="Tamil">Tamoul</option>
                  <option value="Thai">Thailandais</option>
                  <option value="Tibetan">Tibétain</option>
                  <option value="Turkish">Turc</option>
                  <option value="Ukrainian">Ukrénien</option>
                  <option value="Vietnamese">Viétnamien</option>
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
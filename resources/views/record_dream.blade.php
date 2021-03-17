@extends('layouts.app')
@section('content')
<div class="record-container h-100" data-step="1">
    <audio class="d-none" id="audio-record" src=""></audio>
    <div class="step-1 h-100">
        <div class="d-flex flex-column justify-content-between h-100">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column align-items-center text-center header-record">
                    <div class="title text-h1">@lang("Raconte un rêve")</div>
                    <div class="progress-container">
                        <div class="total-bar"></div>
                        <div class="bar bar-25"></div>
                    </div>
                    <div class="description text-h2">
                        @lang("Enregistre ton rêve - intro")
                    </div>
                    <div class="audio-timer">00:00</div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center record-buttons-col">
                    <div class="record-buttons-container">
                        <div class="record button">
                            <img src="img/rec.svg" alt="record" width="92" />
                        </div>
                        <div class="stop button">
                            <img src="img/rec-stop.svg" alt="record" width="92" />
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
                    <div class="record-description text-h2">@lang("Enregistre ton rêve - start")</div>
                    <div class="stop-description text-h2">@lang("Enregistre ton rêve - stop")</div>
                </div>
            </div>
        </div>
    </div>
    <div class="step-2 h-100">
        <div class="h-100 d-flex flex-column justify-content-between">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column align-items-center text-center header-record">
                    <div class="title text-h1">@lang("Valide ton rêve")</div>
                    <div class="progress-container">
                        <div class="total-bar"></div>
                        <div class="bar bar-50"></div>
                    </div>
                    <div class="audio-timer">00:00</div>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column align-items-center text-center">
                    <div class="button">
                        <div id="rec-play">
                            <img src="img/rec-play.svg" width="100" />
                        </div>
                        <div id="rec-stop">
                            <img src="img/rec-stop2.svg" width="100" />
                        </div>
                    </div>
                    <div id="restart" class="button text-h2">
                        <a class="text-decoration-none text-white" href="{{route('record_dream')}}"><u>@lang("Recommencer")</u></a>
                    </div>
                    <div id="save-dream" class="button button-save">
                        @lang("Enregistrer")
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="step-3 h-100">
        <div class="h-100 d-flex flex-column justify-content-between">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column align-items-center text-center">
                    <div class="title text-h1">@lang("Enregistre ton rêve")</div>
                    <div class="progress-container">
                        <div class="total-bar"></div>
                        <div class="bar bar-75"></div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center form">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center">
                    <form method="post" class="send-dream-form">
                        <input type="hidden" id="form_audio_data" name="form_audio_data">
                        <div class="form-entry">
                            <input type="text" name="user_name" id="user_name" maxlength="100" placeholder="@lang('form input - user_name')">
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
                                <option value="French">@lang("Français")</option>
                                <option value="Afrikaans">@lang("Afrikaans")</option>
                                <option value="Albanian">@lang("Albanais")</option>
                                <option value="Arabic">@lang("Arabique")</option>
                                <option value="Armenian">@lang("Arménien")</option>
                                <option value="Basque">@lang("Basque")</option>
                                <option value="Bengali">@lang("Bengalais")</option>
                                <option value="Bulgarian">@lang("Bulgare")</option>
                                <option value="Catalan">@lang("Catalan")</option>
                                <option value="Cambodian">@lang("Cambodgien")</option>
                                <option value="Chinese (Mandarin)">@lang("Chinois (Mandarin)")</option>
                                <option value="Croatian">@lang("Croate")</option>
                                <option value="Czech">@lang("Tchèque")</option>
                                <option value="Danish">@lang("Danois")</option>
                                <option value="Dutch">@lang("Hollandais")</option>
                                <option value="English">@lang("Anglais")</option>
                                <option value="Estonian">@lang("Estonien")</option>
                                <option value="Fiji">@lang("Fidjien")</option>
                                <option value="Finnish">@lang("Finnois")</option>
                                <option value="Georgian">@lang("Géorgien")</option>
                                <option value="German">@lang("Allemand")</option>
                                <option value="Greek">@lang("Grec")</option>
                                <option value="Hebrew">@lang("Hébreux")</option>
                                <option value="Hindi">@lang("Hindi")</option>
                                <option value="Hungarian">@lang("Hongrois")</option>
                                <option value="Icelandic">@lang("Icelandais")</option>
                                <option value="Indonesian">@lang("Indonésien")</option>
                                <option value="Irish">@lang("Irlandais")</option>
                                <option value="Italian">@lang("Italien")</option>
                                <option value="Japanese">@lang("Japonais")</option>
                                <option value="Javanese">@lang("Indonésien")</option>
                                <option value="Korean">@lang("Coréen")</option>
                                <option value="Latin">@lang("Latin")</option>
                                <option value="Latvian">@lang("Latvian")</option>
                                <option value="Lithuanian">@lang("Letton")</option>
                                <option value="Macedonian">@lang("Macédonien")</option>
                                <option value="Malay">@lang("Malais")</option>
                                <option value="Mongolian">@lang("Mongol")</option>
                                <option value="Nepali">@lang("Népalais")</option>
                                <option value="Norwegian">@lang("Norvégien")</option>
                                <option value="Persian">@lang("Persan")</option>
                                <option value="Polish">@lang("Polonais")</option>
                                <option value="Portuguese">@lang("Portugais")</option>
                                <option value="Romanian">@lang("Roumain")</option>
                                <option value="Russian">@lang("Russe")</option>
                                <option value="Serbian">@lang("Serbe")</option>
                                <option value="Slovak">@lang("Slovaque")</option>
                                <option value="Slovenian">@lang("Slovénien")</option>
                                <option value="Spanish">@lang("Espagnol")</option>
                                <option value="Swahili">@lang("Swahili")</option>
                                <option value="Swedish ">@lang("Suédois ")</option>
                                <option value="Tamil">@lang("Tamoul")</option>
                                <option value="Thai">@lang("Thailandais")</option>
                                <option value="Tibetan">@lang("Tibétain")</option>
                                <option value="Turkish">@lang("Turc")</option>
                                <option value="Ukrainian">@lang("Ukrénien")</option>
                                <option value="Vietnamese">@lang("Viétnamien")</option>
                            </select>
                            <div class="error" id="error-lang">@lang('form input - error lang')</div>
                        </div>
                        <div class="form-entry">
                            <input type="email" name="user_email" id="user_email" maxlength="255" placeholder="@lang('form input - user_email')" required>
                            <div class="error" id="error-email">@lang('form input - error email')</div>
                            <div class="info-form">@lang('form info - user_email')</div>
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
    </div>
    <div class="step-4 h-100">
        <div class="h-100 d-flex flex-column justify-content-between">
            <div class="row d-flex justify-content-center">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column align-items-center text-center">
                    <div class="title text-h1">@lang("Rêve enregistré")</div>
                    <div class="progress-container">
                        <div class="total-bar"></div>
                        <div class="bar bar-100"></div>
                    </div>
                    <div class="text-center w-75 thank-text">
                        @lang("Merci - description")
                    </div>
                    <div class="text-center w-75 thank-text">
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
                </div>
            </div>
            <div class="row d-flex justify-content-center end-record">
                <div class="col-12 col-sm-9 col-md-5 col-xxl-4 d-flex flex-column justify-content-center align-items-center text-center">
                    <div class="button button-save">
                        <a href="{{route('welcome')}}" class="text-decoration-none">@lang("Écouter un rêve")</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

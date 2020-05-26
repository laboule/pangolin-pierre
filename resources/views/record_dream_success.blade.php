@extends('layouts.app')

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
        <div class="link-to-user-dream">
            <strong>@lang('Merci - Tu peux écouter ton rêve à cette adresse :')</strong>
            <code>
                <a href="{{ $dream->get_public_url() }}" target="_blank" rel="noopener noreferrer">
                    {{ $dream->get_public_url() }}
                </a>
            </code>
        </div>

        <a href="{{ route('welcome') }}?autoplay=1" class="record-another-dream">
            @lang('Merci - Enregistre un autre rêve')
        </a>
    </div>

@endsection
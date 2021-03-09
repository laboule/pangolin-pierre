<div class="audio-control-wrapper {{ $kind }}" data-autoplay="{{ $autoplay }}">

	@if( $kind == "player" )
    	<button id="start_playing" class="audio-control play">Start playing</button>
    	<button id="stop_playing" class="audio-control stop">Stop playing</button>

    @elseif( $kind == "recorder" )

    	<div class="audio-timer">
            00:00
        </div>

        <button id="start_recording" class="audio-control record">Start recording</button>
        <button id="stop_recording" class="audio-control record-red">Stop recording</button>

        <div class="audio-control-loader loading-encoder">
            <span class="generic-loader"></span>
            <span class="label">@lang('recorder - before record loading')</span>
        </div>

        <div class="audio-control-loader encoding-recording">
            <span class="generic-loader"></span>
            <span class="label">@lang('recorder - while encoding loading')</span>
        </div>

    @endif

    @if( $is_recorder_preview_player || $dream )
	    <div class="native-audio-el-container">
	    	@if( $dream )
		        <div>
		            <audio muted="muted" controls src="{{ $dream->get_recording_file_url() }}"></audio>
		        </div>
			@endif
		</div>
	@endif
</div>
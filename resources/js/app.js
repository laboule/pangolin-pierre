require('./bootstrap');

const LOG_STUFF = true;

function __log(what) {
	if( LOG_STUFF ) {
		console.log(what);
	}
}

$( function() {

	/*
	 * GENERAL UI INTERACTIONS
	 */
	$(document).on('click', '.app-about .read-more', function(e) {
		e.preventDefault();

		let $this = $(this);
		let $about_block = $this.closest('.app-about');

		$about_block.toggleClass('opened');

		if( $about_block.hasClass('opened') ) {
			$this.html($this.attr('data-opened-text'));
		} else {
			$this.html($this.attr('data-closed-text'));
		}

		return false;
	});

	/*
	 * GENERAL AUDIO PLAYER INTERACTIONS
	 */
	window.currently_active_audio_element = null;

	function stop_audio_element_playback(audio_el) {
		audio_el.pause();
		audio_el.src = audio_el.src;

		window.currently_active_audio_element = null;

		$(audio_el).closest('.audio-control-wrapper').attr('data-state', '');
	}

	$('body').on('click', '.audio-control-wrapper.player button', function(e) {
		e.preventDefault();

		let $button = $(this);
		let $wrapper = $button.closest('.audio-control-wrapper');
		let $audio_el = $wrapper.find('.native-audio-el-container audio').eq(0);

		if( ! $audio_el.length ) {
			__log("Can't start playback: No native audio element found.");
			return false;
		}

		let native_audio_el = $audio_el[0];

		if( $wrapper.attr('data-state') != 'is-active' ) {
			/* Play audio */
			$wrapper.attr('data-state', 'is-active');

			var handle_end_of_playback = function() {
				$wrapper.attr('data-state', '');
				native_audio_el.removeEventListener('ended', handle_end_of_playback, false);

				window.currently_active_audio_element = null;
			}

			window.currently_active_audio_element = native_audio_el;

			native_audio_el.addEventListener('ended', handle_end_of_playback, false);
			native_audio_el.play();
		} else {
			/* Stop audio */
			stop_audio_element_playback(native_audio_el);
		}
	});


	/*
	 * HOMEPAGE
	 */
	if( $('body.page_welcome').length ) {

		$(document).on('click', '.play-dream', function(e) {
			e.preventDefault();

			if( $('.audio-control-wrapper.player').attr('data-state') != 'is-active') {
				$('.audio-control-wrapper.player #start_playing').click();
			}

			return false;
		});
	}



	/*
	 * RECORD DREAM PAGE
	 */
	if( $('body.page_record_dream').length ) {

		function toggle_step(step) {
			$('[data-step]').hide();
			$('[data-step="'+step+'"]').show();
		}

		var ENCODING_TYPE = 'mp3'; // wav, mp3, or ogg
		var TIME_LIMIT = 60 * 30; // 30 minutes

		var URL = window.URL || window.webkitURL;

		var gumStream; 						//stream from getUserMedia()
		var recorder; 						//WebAudioRecorder object
		var input; 							//MediaStreamAudioSourceNode  we'll be recording
		var encodingType; 					//holds selected encoding for resulting audio (file)

		var AudioContext = window.AudioContext || window.webkitAudioContext;
		var audioContext; //new audio context to help us record

		var $page = $('body.page_record_dream');

		var recordButton = document.getElementById("start_recording");
		var stopButton = document.getElementById("stop_recording");

		var $audioCSSTimer = $('.audio-timer');
		var audioTimerMinSecs = [0, 0];
		var audioTimerInterval = null;

		recordButton.addEventListener("click", startRecording, false);
		stopButton.addEventListener("click", stopRecording, false);

		function startRecordingTimer() {
			audioTimerMinSecs = [0, 0];

			audioTimerInterval = setInterval( function() {
				audioTimerMinSecs[1] += 1;
				if( audioTimerMinSecs[1] >= 60 ) {
					audioTimerMinSecs[0] += 1;
					audioTimerMinSecs[1] = 0;
				}

				var mins = ("0" + audioTimerMinSecs[0]).slice(-2);
				var secs = ("0" + audioTimerMinSecs[1]).slice(-2);

				$audioCSSTimer.text(mins + ":" + secs);
			}, 1000);
		}

		function changeRecorderStateAttr(new_state) {
			$('.audio-control-wrapper.recorder').attr('data-state', new_state);
		}

		function stopRecordingTimer() {
			clearInterval(audioTimerInterval);
		}

		function onRecordingActuallyStarted() {
			$page.addClass('is-recording');
			changeRecorderStateAttr('is-active');

		    recordButton.disabled = true;
		    stopButton.disabled = false;

		    startRecordingTimer();
		}

		function onRecordingIsPreparing() {
			changeRecorderStateAttr('is-loading');

		    recordButton.disabled = true;
		    stopButton.disabled = true;
		}

		function onRecordingStop() {
			changeRecorderStateAttr('');

	    	stopButton.disabled = true;
	    	recordButton.disabled = false;

	    	stopRecordingTimer();
		}

		function onRecordingIsEncoding() {
			changeRecorderStateAttr('is-encoding');
		}

		function onEncodingComplete() {
			toggle_step(2);
			changeRecorderStateAttr('');
			$page.removeClass('is-recording');
		}

		function startRecording() {
			__log("startRecording() called");

		    var constraints = { audio: true, video:false }

		    onRecordingIsPreparing();

			navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
				__log("getUserMedia() success, stream created, initializing WebAudioRecorder...");

				audioContext = new AudioContext();
				gumStream = stream;
				input = audioContext.createMediaStreamSource(stream);

				//stop the input from playing back through the speakers
				//input.connect(audioContext.destination)

				encodingType = ENCODING_TYPE;

				recorder = new WebAudioRecorder(input, {
					workerDir: "js/webaudiorecorder/", // must end with slash
					encoding: encodingType,
					numChannels: 2, //2 is the default, mp3 encoding supports only 2

					onEncoderLoading: function(recorder, encoding) {
						__log("Loading "+encoding+" encoder...");
					},

					onEncoderLoaded: function(recorder, encoding) {
						__log(encoding+" encoder loaded");
						onRecordingActuallyStarted();
					},

					onComplete: function(recorder, blob) {
						__log("Encoding complete");
						createAudioElementFromBlob(blob,recorder.encoding);
						onEncodingComplete();
					}
				});

				recorder.setOptions({
					timeLimit: TIME_LIMIT,
					encodeAfterRecord: true,
					ogg: {quality: 0.5},
					mp3: {bitRate: 160}
			    });

				recorder.startRecording();

				__log("Recording started");

			}).catch(function(err) {
				onRecordingStop();
			});
		}

		function stopRecording() {
			__log("stopRecording() called");

			//stop microphone access
			gumStream.getAudioTracks()[0].stop();

			//disable the stop button
			onRecordingStop();
			onRecordingIsEncoding();

			//tell the recorder to finish the recording (stop recording + encode the recorded audio)
			recorder.finishRecording();

			__log('Recording stopped');
		}

		function createAudioElementFromBlob(blob, encoding) {
			var url = URL.createObjectURL(blob);
			var au = document.createElement('audio');
			var au_wrapper = document.createElement('div');

			//add controls to the <audio> element
			au.controls = true;
			au.src = url;

			//add the new audio and a elements to the au_wrapper element
			au_wrapper.appendChild(au);

			//add the au_wrapper element to the ordered list
			$('.native-audio-el-container').html('');
			$('.native-audio-el-container')[0].appendChild(au_wrapper);

			// Adds binary data to form input
			var reader = new FileReader();
			reader.onload = function(event){
                $('#form_audio_data').val( event.target.result );
            };
            reader.readAsDataURL(blob);
		}


		/* Reset / Accept recording buttons */
		$('.validate-recording-buttons button').on('click', function(e) {
			e.preventDefault();

			if( window.currently_active_audio_element ) {
				stop_audio_element_playback(window.currently_active_audio_element);
			}

			if( $(this).hasClass('start-again') ) {
				toggle_step(1);
			}

			if( $(this).hasClass('validate') ) {
				toggle_step(3);
			}
		})
	}
});
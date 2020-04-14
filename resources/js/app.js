require('./bootstrap');

$( function() {

	/*
	 * HOMEPAGE
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
	 * RECORD DREAM PAGE
	 */
	if( $('body.page_record_dream').length ) {

		var ENCODING_TYPE = 'wav'; // wav, mp3, or ogg
		var TIME_LIMIT = 120; // 2 minutes

		var URL = window.URL || window.webkitURL;

		var gumStream; 						//stream from getUserMedia()
		var recorder; 						//WebAudioRecorder object
		var input; 							//MediaStreamAudioSourceNode  we'll be recording
		var encodingType; 					//holds selected encoding for resulting audio (file)
		var encodeAfterRecord = true;       // when to encode

		var AudioContext = window.AudioContext || window.webkitAudioContext;
		var audioContext; //new audio context to help us record

		var recordButton = document.getElementById("start_recording");
		var stopButton = document.getElementById("stop_recording");

		recordButton.addEventListener("click", startRecording);
		stopButton.addEventListener("click", stopRecording);

		function startRecording() {
			console.log("startRecording() called");

		    var constraints = { audio: true, video:false }

			navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
				console.log("getUserMedia() success, stream created, initializing WebAudioRecorder...");

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
						console.log("Loading "+encoding+" encoder...");
					},
					onEncoderLoaded: function(recorder, encoding) {
						console.log(encoding+" encoder loaded");
					}
				});

				recorder.onComplete = function(recorder, blob) {
					console.log("Encoding complete");
					createDownloadLink(blob,recorder.encoding);
				}

				recorder.setOptions({
					timeLimit: TIME_LIMIT,
					encodeAfterRecord: encodeAfterRecord,
					ogg: {quality: 0.5},
					mp3: {bitRate: 160}
			    });

				recorder.startRecording();

				console.log("Recording started");

			}).catch(function(err) {

		    	recordButton.disabled = false;
		    	stopButton.disabled = true;

			});

		    recordButton.disabled = true;
		    stopButton.disabled = false;
		}

		function stopRecording() {
			console.log("stopRecording() called");

			//stop microphone access
			gumStream.getAudioTracks()[0].stop();

			//disable the stop button
			stopButton.disabled = true;
			recordButton.disabled = false;

			//tell the recorder to finish the recording (stop recording + encode the recorded audio)
			recorder.finishRecording();

			console.log('Recording stopped');
		}

		function createDownloadLink(blob, encoding) {
			
			var url = URL.createObjectURL(blob);
			var au = document.createElement('audio');
			var li = document.createElement('li');
			var link = document.createElement('a');

			//add controls to the <audio> element
			au.controls = true;
			au.src = url;

			//link the a element to the blob
			link.href = url;
			link.download = new Date().toISOString() + '.'+encoding;
			link.innerHTML = link.download;

			//add the new audio and a elements to the li element
			li.appendChild(au);
			li.appendChild(link);

			//add the li element to the ordered list
			$('.recorder-result')[0].appendChild(li);
		}
	}
});
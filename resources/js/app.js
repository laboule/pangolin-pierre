require("./bootstrap");

const LOG_STUFF = true;

const __log = (what) => {
	if (LOG_STUFF) {
		console.log(what);
	}
};

const capitalize = (s) => {
	if (typeof s !== "string") return "";
	return s.charAt(0).toUpperCase() + s.slice(1);
};

const generateRandomNumber = (start = 0, end = 1) =>
	Math.floor(Math.random() * (end - start + 1)) + start;

/**
 * Datepicker configuration
 */
$.datepicker.regional["fr"] = {
	prevText: "<",
	nextText: ">",
	monthNames: [
		"Janvier",
		"Février",
		"Mars",
		"Avril",
		"Mai",
		"Juin",
		"Juillet",
		"Août",
		"Septembre",
		"Octobre",
		"Novembre",
		"Décembre",
	],
	monthNamesShort: [
		"Jan",
		"Fév",
		"Mar",
		"Avr",
		"Mai",
		"Jun",
		"Jul",
		"Aoû",
		"Sep",
		"Oct",
		"Nov",
		"Déc",
	],
	dayNamesShort: ["Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam"],
	dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
};
$.datepicker.setDefaults($.datepicker.regional["fr"]);

$(function() {
	const app_url = $("body").data("appurl");
	let currDream = {};
	/*
	 * HOME PAGE
	 */
	/** info button */
	$(".read-more").click(() => $(".text-wrapper").toggle());
	$("#close-info").click(() => $(".text-wrapper").hide());
	let listenCount = 0;
	let modalCount = generateRandomNumber(2,3);
	console.log("Display modal after", modalCount, "listens");

	const updateDomWithNewDream = (dream) => {
		let { user_name, dream_is_nsfw, user_city, dream_date, url } = dream;
		let date = new Date(dream_date);
		const options = { year: "numeric", month: "long" };
		date = date.toLocaleDateString("fr-FR", options);
		$("#name").text(capitalize(user_name.toLowerCase()));
		$("#city").text(capitalize(user_city.toLowerCase()));
		$("#date").text(capitalize(date));
		$("#audio").attr("src", url);
		dream_is_nsfw ? $("#nsfw").show() : $("#nsfw").hide();
	};

	/** Fetch a dream from api */
	const fetchDream = async function() {
		let dream = await $.get(app_url + "/api/dream?not=" + currDream.id);
		currDream = dream;
		return dream;
	};

	const showButton = (button = "play") => {
		if (button === "play") {
			$("#stop").hide();
			$("#play").show();
		} else if (button === "stop") {
			$("#play").hide();
			$("#stop").show();
		}
	};

	/** If a dream is passed from welcome controller */
	if ($(".listen-container").data("dream")) {
		let dream = $(".listen-container").data("dream");
		console.log("dream", dream);
		updateDomWithNewDream(dream);
		$("#listen-button").hide();
		$("#listen-player").show();
		let audio = $("#audio")[0];
		if (audio) {
			showButton("play");
		}
	}

	/** First button : "Ecouter un rêve" => fetch a dream  and show player */
	$("#listen-button").click(async function() {
		$(this).hide();
		$("#listen-player").show();
		let dream = await fetchDream();
		if (dream) {
			updateDomWithNewDream(dream);
			let audio = $("#audio")[0];
			if (audio) {
				showButton("stop");
				audio.play();
			}
		}
	});

	/** Stop audio */
	$("#stop").click(function() {
		let audio = $("#audio")[0];
		showButton("play");
		if (audio) audio.pause();
	});
	/** Play audio */
	$("#play").click(function() {
		let audio = $("#audio")[0];
		showButton("stop");
		if (audio) audio.play();
	});

	/** Next dream */
	$("#next").click(async function() {
		let dream = await fetchDream();
		if (dream) {
			updateDomWithNewDream(dream);
			showButton("stop");
			let audio = $("#audio")[0];
			if (audio) audio.play();
		}
	});

	/** progress bar and autoplay */
	$("#audio").bind("timeupdate", async function() {
		let widthOfProgressBar = this.currentTime / this.duration;
		let newWidth = Math.floor(
			widthOfProgressBar * $(".listen-container .total-bar").width()
		);
		$(".listen-container .bar").width(newWidth);
		// On audio end
		if (widthOfProgressBar === 1) {
			// show play button and fetch a new dream
			showButton("play");
			let dream = await fetchDream();
			if (dream) {
				// update dom
				updateDomWithNewDream(dream);

				// Check listen count
				listenCount++;
				if (listenCount >= modalCount) {
					// show modal
					$(".listen-modal").show();
					// reset count
					listenCount = 0;
					modalCount = generateRandomNumber(2,3);
					return;
				}

				// autoplay audio
				showButton("stop");
				let audio = $("#audio")[0];
				if (audio) audio.play();
			}
		}
	});

	$("#continue-listen, #close-listen-modal").click(() => {
		$(".listen-modal").hide();
		// autoplay audio
		showButton("stop");
		let audio = $("#audio")[0];
		if (audio) audio.play();
	});

	/*
	 * RECORD DREAM PAGE
	 */
	let currentStep = $(".record-container").data("step");
	const ENCODING_TYPE = window.global_public_data.dream_audio_format; // wav, mp3, or ogg
	const TIME_LIMIT = window.global_public_data.dream_max_length; // Max length of recording in seconds
	const URL = window.URL || window.webkitURL;

	let gumStream; //stream from getUserMedia()
	let recorder; //WebAudioRecorder object
	let input; //MediaStreamAudioSourceNode  we'll be recording
	let encodingType; //holds selected encoding for resulting audio (file)

	let AudioContext = window.AudioContext || window.webkitAudioContext;
	let audioContext; //new audio context to help us record
	let audioTimerInterval = null;

	$(".record-container .record").click(async function() {
		$(this).hide();
		$(".record-container .record-description").hide();
		$(".loading-encoder.start").show();
		await startRecording();
	});

	$(".record-container .stop").click(async function() {
		$(this).hide();
		$(".record-container .stop-description").hide();
		$(".loading-encoder.end").show();
		await stopRecording();
	});

	$("#rec-play").click(() => {
		$("#rec-play").hide();
		$("#rec-stop").show();
		let audio = $("#audio-record")[0];
		if (audio) audio.play();
	});
	$("#rec-stop").click(() => {
		$("#rec-stop").hide();
		$("#rec-play").show();
		let audio = $("#audio-record")[0];
		if (audio) audio.pause();
	});

	$("#save-dream").click(() => {
		let audio = $("#audio-record")[0];
		if (audio) audio.pause();
		toggleStep(3);
	});

	$("#audio-record").bind("timeupdate", async function(e) {
		let currentTime = this.currentTime;
		if (currentTime > 0) {
			let mins = Math.floor(currentTime / 60);
			let secs = Math.floor(currentTime - mins * 60);
			// console.log(mins, secs)
			const minutes = ("0" + mins).slice(-2);
			const seconds = ("0" + secs).slice(-2);
			$(".audio-timer").text(`${minutes}:${seconds}`);
		}
		if (currentTime === this.duration) {
			$("#rec-stop").hide();
			$("#rec-play").show();
		}
	});

	$("#dream_date").datepicker();

	/**Form Submit handler **/
	$("#submit").click(async (e) => {
		// prevent submission
		e.preventDefault();

		// Hide previous errors
		$("#error-email").hide();
		$("#error-email").hide();

		// retrieve and format values
		let values = $("form").serializeArray();
		values = values.reduce((acc, { name, value }) => {
			acc[name] = value;
			return acc;
		}, {});

		console.log(values);

		if (!values.user_email) {
			$("#error-email").show();
			return;
		}
		if (!values.dream_language) {
			$("#error-lang").show();
			return;
		}

		try {
			let res = await $.post(app_url + "/api/record_dream", {
				...values,
			});
			if (res && res.status === "success") {
				// final step
				toggleStep(4);
			} else {
				console.log("there was an error", res);
				// show error message
				alert("impossible de sauvegarder le rêve !");
			}
		} catch (e) {
			console.log("error", e);
			// show error message
			alert("impossible de sauvegarder le rêve !");
		}
	});

	function startRecordingTimer() {
		let [mins, secs] = [0, 0];
		audioTimerInterval = setInterval(function() {
			secs++;
			if (secs >= 60) {
				mins++;
				secs = 0;
			}
			const minutes = ("0" + mins).slice(-2);
			const seconds = ("0" + secs).slice(-2);
			$(".audio-timer").text(`${minutes}:${seconds}`);
		}, 1000);
	}

	function stopRecordingTimer() {
		clearInterval(audioTimerInterval);
	}

	const toggleStep = (step) => {
		$(`.step-${currentStep}`).hide();
		currentStep = step;
		$(`.step-${currentStep}`).show();
	};
	const onComplete = (recorder, blob) => {
		__log("Encoding complete");
		$(".record-container .loading-encoder.end").hide();
		createAudioElementFromBlob(blob, recorder.encoding);
		toggleStep(2);
	};

	const onEncoderLoaded = (recorder, encoding) => {
		__log(encoding + " encoder loaded");
		startRecordingTimer();
		$(".record-container .description").hide();
		$(".record-container .audio-timer").show();
		$(".record-container .loading-encoder.start").hide();
		$(".record-container .stop").show();
		$(".record-container .stop-description").show();
	};

	async function startRecording() {
		try {
			console.log("startRecording() called");
			const constraints = { audio: true, video: false };
			let stream = await navigator.mediaDevices.getUserMedia(constraints);
			__log(
				"getUserMedia() success, stream created, initializing WebAudioRecorder..."
			);
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
				onEncoderLoading: (recorder, encoding) =>
					__log("Loading " + encoding + " encoder..."),
				onEncoderLoaded,
				onComplete,
			});

			recorder.setOptions({
				timeLimit: TIME_LIMIT,
				encodeAfterRecord: true,
				ogg: { quality: 0.5 },
				mp3: { bitRate: 160 },
			});

			recorder.startRecording();

			__log("Recording started");
		} catch (e) {
			console.log("error startRecording", e);
			stopRecordingTimer();
		}
	}

	function stopRecording() {
		__log("stopRecording() called");
		stopRecordingTimer();

		//stop microphone access
		gumStream.getAudioTracks()[0].stop();

		//tell the recorder to finish the recording (stop recording + encode the recorded audio)
		recorder.finishRecording();

		__log("Recording stopped");
	}

	function createAudioElementFromBlob(blob, encoding) {
		const url = URL.createObjectURL(blob);
		$("#audio-record").attr("src", url);

		// Adds binary data to form input
		var reader = new FileReader();
		reader.onload = function() {
			$("#form_audio_data").val(reader.result);
		};
		reader.readAsDataURL(blob);
	}
});

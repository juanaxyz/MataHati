<?php
include './config/database.php'; // Pastikan koneksi database sudah benar
session_start();
$account_type = $_SESSION['accountType'];


if ($account_type    == "volunteer") {
    // echo $account_type;
    header("Location: comp/error.html");
    exit();
}

if (isset($_POST["logout"])) {

    session_unset();
    session_destroy();
    header("location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Call - Blind</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
        .call-button-wrapper {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        #local {
            width: 100%;
            height: 100vh;
            object-fit: cover;
        }

        #remote {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 200px;
            height: 150px;
            z-index: 10;
            border: 3px solid white;
            border-radius: 10px;
            background-color: black;
        }

        .logout-btn {
            position: absolute;
            top: 0;
            right: 100;
            z-index: 10;
        }
    </style>
</head>

<body class="bg-dark vh-100 overflow-hidden position-relative">
    <div class="position-absolute top-0 start-0 p-3">
        <form action="blind.php" method="POST">
            <button type="submit" class="logout-btn" name="logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </div>

    <div id="remote" class="bg-dark d-flex justify-content-center align-items-center text-white"></div>

    <div id="local" class="d-flex justify-content-center align-items-center text-white">
    </div>

    <div class="call-button-wrapper">
        <button id="btnPlug" class="non-active btn btn-primary rounded-circle d-flex justify-content-center align-items-center" style="width: 80px; height: 80px;">
            <i class="fa fa-phone fa-2x"></i>
        </button>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./assets/js/AgoraRTC_N-4.2.1.js"></script>
    <script>
        const accountType = 'blind';
    </script>
    <script>
        class VoiceRecognitionApp {
            constructor() {
                this.btnPlug = document.getElementById('btnPlug');
                this.recognition = null;
                this.isPlugActive = false;

                // Perintah suara
                this.voiceCommands = {
                    'call.': () => this.togglePlug(),
                    'help.': () => this.togglePlug(),
                };

                if (this.btnPlug) {
                    this.btnPlug.addEventListener('click', () => this.togglePlug());
                }

                this.initRecognition();
            }

            togglePlug() {
                if (!this.isPlugActive) {
                    // Activate
                    this.btnPlug.classList.remove('non-active');
                    this.btnPlug.classList.add('active');
                    this.btnPlug.style.color = 'red';
                    this.isPlugActive = true;

                    // Start video call
                    startOneToOneVideoCall();

                } else {
                    // Deactivate
                    this.btnPlug.classList.add('non-active');
                    this.btnPlug.classList.remove('active');
                    this.btnPlug.style.color = 'black';
                    this.isPlugActive = false;

                    // Stop video call

                    rtc.client.leave();
                    stopVideo();
                    stopAudio();
                }
            }

            initRecognition() {
                // Cek dukungan browser
                const SpeechRecognition =
                    window.SpeechRecognition ||
                    window.webkitSpeechRecognition;

                if (!SpeechRecognition) {
                    console.log('Browser tidak mendukung Voice Recognition');
                    return;
                }

                this.recognition = new SpeechRecognition();

                // Konfigurasi
                this.recognition.continuous = true;
                this.recognition.lang = 'en-US';
                this.recognition.interimResults = false;
                this.recognition.maxAlternatives = 1;

                // Event handlers

                this.recognition.onresult = (event) => {
                    const speechResult = event.results[event.results.length - 1][0].transcript.toLowerCase().trim();
                    this.processCommand(speechResult);
                };

                this.recognition.onerror = (event) => {
                    this.status.innerHTML = 'Error: ' + event.error;
                    this.status.style.color = 'red';
                };

                this.recognition.onend = () => {
                    // Restart otomatis jika error atau berhenti
                    this.recognition.start();
                };

                // Mulai saat window load
                window.addEventListener('load', () => {
                    try {
                        this.recognition.start();
                    } catch (error) {
                        this.status.innerHTML = 'Gagal memulai: ' + error.message;
                    }
                });
            }

            processCommand(speechResult) {
                console.log(`Terdeteksi: "${speechResult}"`);


                // Cek perintah
                Object.keys(this.voiceCommands).forEach(command => {
                    if (speechResult.includes(command)) {
                        this.voiceCommands[command]();
                    }
                });
            }


        }

        // Inisialisasi aplikasi
        new VoiceRecognitionApp();



        // RTC


        const config = {
            mode: 'rtc',
            codec: 'vp8'
        }

        const options = {
            appId: '7a75eea3ae5b4987a9044761c459a6d3',
            channel: 'main',
            token: null,
        }

        const rtc = {
            client: null,
            localVideoTrack: null,
            localAudioTrack: null,
        }
        const btnCam = $('#btnCam');
        const btnMic = $('#btnMic');
        const btnPlug = $('#btnPlug');
        const remote = $('#remote');
        const local = $('#local');



        const join = async () => {
            rtc.client = AgoraRTC.createClient(config);
            await rtc.client.join(options.appId, options.channel, options.token || null);
        }

        async function startOneToOneVideoCall() {
            join().then(() => {
                startVideo();
                startAudio();

                rtc.client.on('user-published', async (user, mediaType) => {
                    // Confirmation only for volunteer (answerer)
                    if (accountType == "volunteer") {
                        const acceptCall = confirm("Panggilan masuk, apakah Anda ingin menjawab?");
                        if (!acceptCall) {
                            console.log("Panggilan ditolak.");
                            return;
                        }
                    }

                    console.log("Panggilan diterima.");
                    await rtc.client.subscribe(user, mediaType);

                    if (rtc.client._users.length > 1) {
                        rtc.client.leave();
                        remote.html('<div class="roomMessage"><p class="full">Please Wait Room is Full</p></div>');
                        return;
                    } else {
                        remote.html('');
                    }

                    await rtc.client.subscribe(user, mediaType);
                    if (mediaType === 'video') {
                        const remoteVideoTrack = user.videoTrack;
                        remoteVideoTrack.play('remote');
                    }
                    if (mediaType === 'audio') {
                        const remoteAudioTrack = user.audioTrack;
                        remoteAudioTrack.play()
                    }
                });
            });
        }

        const startVideo = async () => {
            rtc.localVideoTrack = await AgoraRTC.createCameraVideoTrack();

            rtc.client.publish(rtc.localVideoTrack);
            rtc.localVideoTrack.play('local');
        }

        const startAudio = async () => {
            rtc.localAudioTrack = await AgoraRTC.createMicrophoneAudioTrack();
            rtc.client.publish(rtc.localAudioTrack);
            rtc.localAudioTrack.play();
        }

        const stopVideo = () => {
            rtc.localVideoTrack.close();
            rtc.localVideoTrack.stop();
            rtc.client.unpublish(rtc.localVideoTrack);
        }

        const stopAudio = () => {
            rtc.localAudioTrack.close();
            rtc.localAudioTrack.stop();
            rtc.client.unpublish(rtc.localAudioTrack);
        }

        // Toggle Camera
        btnCam.click(function() {
            if ($(this).hasClass('fa-video-camera')) {
                $(this).addClass('fa-video-slash');
                $(this).removeClass('fa-video-camera');
                $(this).css('color', 'red');
                stopVideo();
            } else {
                $(this).addClass('fa-video-camera');
                $(this).removeClass('fa-video-slash');
                $(this).css('color', 'black');
                startVideo();
            }
        });

        // Toggle Microphone
        btnMic.click(function() {
            if ($(this).hasClass('fa-microphone')) {
                $(this).addClass('fa-microphone-slash');
                $(this).removeClass('fa-microphone');
                $(this).css('color', 'red');
                stopAudio()
            } else {
                $(this).addClass('fa-microphone');
                $(this).removeClass('fa-microphone-slash');
                $(this).css('color', 'black');
                startAudio();
            }
        });

        // Toggle Join and Leave
        btnPlug.click(function() {
            if ($(this).hasClass('non-active')) {
                $(this).removeClass('non-active');
                $(this).addClass('active');
                $(this).css('color', 'red');
                startOneToOneVideoCall();
            } else {
                $(this).addClass('non-active');
                $(this).removeClass('active');
                $(this).css('color', 'black');

                rtc.client.leave();
                stopVideo();
                stopAudio();
            }
        })


        ;
    </script>
</body>

</html>
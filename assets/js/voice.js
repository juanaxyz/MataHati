class VoiceRecognitionApp {
    constructor() {
        this.status = document.getElementById('status');
        this.output = document.getElementById('output');
        this.recognition = null;
        
        // Perintah suara
        this.voiceCommands = {
            'call': () => this.callCommand(),
            'telepon': () => this.callCommand(),
            'help': () => this.callCommand(),
        };

        this.initRecognition();
    }

    initRecognition() {
        // Cek dukungan browser
        const SpeechRecognition = 
            window.SpeechRecognition || 
            window.webkitSpeechRecognition;

        if (!SpeechRecognition) {
            this.status.innerHTML = 'Browser tidak mendukung Voice Recognition';
            return;
        }

        this.recognition = new SpeechRecognition();
        
        // Konfigurasi
        this.recognition.continuous = true;
        this.recognition.lang = 'id-ID';
        this.recognition.interimResults = false;
        this.recognition.maxAlternatives = 1;

        // Event handlers
        this.recognition.onstart = () => {
            this.status.innerHTML = 'Voice Recognition Aktif';
        };

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
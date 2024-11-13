<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MataHati</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <script src="https://code.responsivevoice.org/responsivevoice.js?key=O4BwsMp0"></script>
    <style>
        /* Tambahkan beberapa gaya untuk panel dan tombol */
        #statusPanel {
            height: 100vh;
            /* Panel status akan mengisi tinggi layar */
            overflow-y: auto;
            /* Jika konten lebih banyak, tambahkan scrollbar */
            padding: 20px;
            /* Beri sedikit padding untuk estetika */
        }

        .big-button {
            width: 100%;
            /* Tombol akan mengambil lebar penuh */
            height: 100px;
            /* Tinggi tombol */
            font-size: 1.5rem;
            /* Ukuran font yang lebih besar */
        }

        @media (max-width: 768px) {
            /* Di mobile, kita bisa menyesuaikan gaya lebih lanjut jika diperlukan */
            #statusPanel {
                height: auto;
                /* Panel tidak perlu mengisi tinggi layar */
            }
        }

        .row {
            height: 100vh;
        }
        .rounded-circle{
            width: 400px;
            height: 400px;
            text-align: center;
        }
    </style>
</head>

<body>
    <section class="container-fluid text-center">
        <div class="row">
            <div class="col-lg-2 col-md-12 bg-primary" id="statusPanel">
                <h5>Status Online</h5>
                <p id="onlineCount">Jumlah Orang Online: <strong id="onlineNumber">5</strong></p>
            </div>
            <div class="col-lg-10 col-md-12 d-flex align-items-center bg-secondary">
                <div class="w-100 border border-5">
                    <div class="rounded-circle bg-danger" id="speakButton">Call Volunteer</div>
                </div>
            </div>
        </div>
    </section>

    <script src="./assets/js/bootstrap.min.js"></script>
    <script>
        // Fungsi untuk berbicara
        function speak(text) {
            responsiveVoice.speak(text, "Indonesian Female");
        }

        // Event listener untuk bagian status
        document.getElementById('statusPanel').addEventListener('click', function() {
            const onlineCount = document.getElementById('onlineNumber').textContent;
            const text = `Jumlah orang online ada: ${onlineCount} pengguna`;
            speak(text);
        });

        // Event listener untuk tombol
        document.getElementById('speakButton').addEventListener('click', function() {
            const text = "Melakukan Panggilan. Silahkan Tunggu...!";
            speak(text);
        });
    </script>
</body>

</html>
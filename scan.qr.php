<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan QR Code</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <style>
        .result {
            background-color: green;
            color: #fff;
            padding: 20px;
        }
        .row {
            display: flex;
        }
        #reader {
            width: 500px;
            height: 500px; /* Menentukan tinggi untuk area pemindaian */
            border: 1px solid #ccc; /* Tambahkan border untuk melihat area pemindai */
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col">
            <div id="reader"></div>
            <audio id="myAudio1">
                <source src="success.mp3" type="audio/ogg">
                Your browser does not support the audio element.
            </audio>
            <audio id="myAudio2">
                <source src="failes.mp3" type="audio/ogg">
                Your browser does not support the audio element.
            </audio>
        </div>
        <div class="col" style="padding:30px;">
            <h4>SCAN RESULT</h4>
            <div>Employee name</div>
            <form action="">
                <input type="text" name="start" class="input" id="result" onkeyup="showHint(this.value)" placeholder="result here" readonly="" />
            </form>
            <p>Status: <span id="txtHint"></span></p>
        </div>
    </div>
</div>

<script>
    // Mengambil elemen audio
    var successAudio = document.getElementById("myAudio1");
    var failAudio = document.getElementById("myAudio2");

    // Fungsi untuk menampilkan hint berdasarkan input
    function showHint(str) {
        if (str.length == 0) {
            document.getElementById("txtHint").innerHTML = "";
            return;
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("txtHint").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "gethint.php?q=" + str, true);
            xmlhttp.send();
        }
    }

    // Memainkan audio saat QR Code berhasil dipindai
    function playAudio() { 
        successAudio.play(); 
    } 

    // Callback saat QR code terdeteksi
    function onScanSuccess(qrCodeMessage) {
        document.getElementById("result").value = qrCodeMessage;
        showHint(qrCodeMessage);
        playAudio(); // Memainkan audio berhasil
    }

    // Callback saat ada kesalahan saat pemindaian
    function onScanError(errorMessage) {
        console.warn("Kesalahan pemindaian: ", errorMessage);
        // Anda bisa memainkan audio kesalahan jika diperlukan
        // failAudio.play();
    }

    // Inisialisasi pemindai QR Code
    var html5QrcodeScanner = new Html5QrcodeScanner("reader", { 
        fps: 10, 
        qrbox: 250 
    });
    html5QrcodeScanner.render(onScanSuccess, onScanError);
</script>

</body>
</html>

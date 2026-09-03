/**
 * QR Code Scanner — PKKMB Narotama 2026
 * public/js/home/qrcode.js
 *
 * Html5Qrcode langsung + dropdown pilih kamera.
 * formatsToSupport dipasang di constructor agar decoding QR aktif.
 */

var scanner = null;
var scanProcessed = false;
var scannerStarting = false;


// ======================================================
// QR BERHASIL DIBACA
// ======================================================

function onScanSuccess(decodedText, decodedResult) {

    if (scanProcessed) {
        return;
    }

    scanProcessed = true;

    console.log("[QR] QR TERDETEKSI:", decodedText);

    var codeField = document.getElementById("code-field");
    var form = document.getElementById("kirim-presensi");

    if (!codeField) {
        console.error("[QR] #code-field tidak ditemukan.");
        scanProcessed = false;
        return;
    }

    if (!form) {
        console.error("[QR] #kirim-presensi tidak ditemukan.");
        scanProcessed = false;
        return;
    }

    codeField.value = decodedText;

    console.log("[QR] CODE FIELD:", codeField.value);

    // Hentikan scanner
    scanner.stop()
        .then(function () {
            console.log("[QR] Kamera dihentikan.");
            return scanner.clear();
        })
        .then(function () {
            console.log("[QR] Submit presensi otomatis.");
            form.submit();
        })
        .catch(function (error) {
            console.error("[QR] Gagal stop scanner:", error);
            // Tetap submit agar presensi tidak gagal
            form.submit();
        });
}


// ======================================================
// ERROR SCAN (diabaikan agar console tidak penuh)
// ======================================================

function onScanError(errorMessage) {
    // sengaja kosong
}


// ======================================================
// MULAI KAMERA BERDASARKAN ID
// ======================================================

function startCamera(cameraId) {

    if (scanner || scannerStarting) {
        return;
    }

    var reader = document.getElementById("reader");

    if (!reader) {
        console.error("[QR] #reader tidak ditemukan.");
        return;
    }

    if (typeof Html5Qrcode === "undefined") {
        console.error("[QR] Html5Qrcode TIDAK TERLOAD.");
        return;
    }

    scannerStarting = true;
    scanProcessed = false;

    console.log("[QR] Scanner starting");
    console.log("[QR] Camera selected:", cameraId);

    // PENTING: formatsToSupport HARUS ada di constructor
    // agar library benar-benar melakukan QR decoding,
    // bukan sekadar menampilkan video kamera.
    scanner = new Html5Qrcode("reader", {
        formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
        verbose: false
    });

    scanner.start(
        cameraId,
        {
            fps: 15,
            qrbox: {
                width: 280,
                height: 280
            },
            aspectRatio: 1.0,
            disableFlip: false
        },
        onScanSuccess,
        onScanError
    )
        .then(function () {
            scannerStarting = false;
            console.log("[QR] Camera started");
        })
        .catch(function (error) {
            scannerStarting = false;
            scanner = null;
            console.error("[QR] KAMERA GAGAL:", error);
        });
}


// ======================================================
// STOP KAMERA
// ======================================================

function stopCamera() {

    if (!scanner) {
        return;
    }

    console.log("[QR] STOP KAMERA");

    scanner.stop()
        .then(function () {
            return scanner.clear();
        })
        .then(function () {
            console.log("[QR] Kamera dihentikan.");
            scanner = null;
            scannerStarting = false;
            scanProcessed = false;
        })
        .catch(function () {
            scanner = null;
            scannerStarting = false;
            scanProcessed = false;
        });
}


// ======================================================
// GANTI KAMERA
// ======================================================

function switchCamera(cameraId) {

    if (scanner) {
        scanner.stop()
            .then(function () {
                return scanner.clear();
            })
            .then(function () {
                console.log("[QR] Kamera lama dihentikan.");
                scanner = null;
                scannerStarting = false;
                scanProcessed = false;
                startCamera(cameraId);
            })
            .catch(function () {
                scanner = null;
                scannerStarting = false;
                scanProcessed = false;
                startCamera(cameraId);
            });
    } else {
        startCamera(cameraId);
    }
}


// ======================================================
// BUAT UI DROPDOWN PILIH KAMERA
// ======================================================

function buildCameraUI(cameras) {

    var reader = document.getElementById("reader");

    if (!reader) {
        return;
    }

    // Bersihkan area reader
    reader.innerHTML = "";

    // Container dropdown
    var container = document.createElement("div");
    container.id = "qr-camera-selector";
    container.style.cssText =
        "padding: 16px; text-align: center; font-family: sans-serif;";

    // Label
    var label = document.createElement("label");
    label.textContent = "Pilih Kamera";
    label.setAttribute("for", "qr-camera-select");
    label.style.cssText =
        "display: block; margin-bottom: 8px; font-weight: bold; " +
        "font-size: 14px; color: #f0f0f0;";
    container.appendChild(label);

    // Dropdown
    var select = document.createElement("select");
    select.id = "qr-camera-select";
    select.style.cssText =
        "width: 100%; max-width: 400px; padding: 10px 12px; " +
        "font-size: 14px; border-radius: 8px; border: 1px solid #444; " +
        "background: #1a1a2e; color: #f0f0f0; cursor: pointer; outline: none;";

    // Opsi default
    var defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "-- Pilih Kamera --";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    select.appendChild(defaultOption);

    // Isi opsi kamera
    for (var i = 0; i < cameras.length; i++) {
        var option = document.createElement("option");
        option.value = cameras[i].id;
        option.textContent = cameras[i].label || ("Kamera " + (i + 1));
        select.appendChild(option);
    }

    container.appendChild(select);

    // Sisipkan dropdown di atas reader
    reader.parentNode.insertBefore(container, reader);

    // Event: user memilih kamera
    select.addEventListener("change", function () {
        var selectedId = this.value;

        if (!selectedId) {
            return;
        }

        console.log("[QR] Camera selected:", selectedId);

        switchCamera(selectedId);
    });

    // Jika hanya 1 kamera, langsung gunakan
    if (cameras.length === 1) {
        select.value = cameras[0].id;
        console.log(
            "[QR] Hanya 1 kamera, langsung digunakan:",
            cameras[0].label || cameras[0].id
        );
        startCamera(cameras[0].id);
    }
}


// ======================================================
// INISIALISASI: MINTA PERMISSION & CARI KAMERA
// ======================================================

function initScanner() {

    if (typeof Html5Qrcode === "undefined") {
        console.error("[QR] Library Html5Qrcode TIDAK TERLOAD.");
        return;
    }

    console.log("[QR] MENCARI KAMERA...");

    Html5Qrcode.getCameras()
        .then(function (cameras) {

            console.log("[QR] KAMERA DITEMUKAN:", cameras);

            if (!cameras || cameras.length === 0) {
                console.error("[QR] TIDAK ADA KAMERA.");
                return;
            }

            buildCameraUI(cameras);
        })
        .catch(function (error) {
            console.error("[QR] GAGAL AMBIL DAFTAR KAMERA:", error);
        });
}


// ======================================================
// POLLING: TUNGGU #reader & #scannerModal TERSEDIA
// ======================================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("[QR] SCRIPT AKTIF");

    var attempts = 0;

    var timer = setInterval(function () {

        attempts++;

        var reader = document.getElementById("reader");
        var modal = document.getElementById("scannerModal");

        if (reader && modal) {

            console.log("[QR] READER & MODAL DITEMUKAN");
            clearInterval(timer);

            setTimeout(function () {
                initScanner();
            }, 500);
        }

        if (attempts >= 30) {
            clearInterval(timer);
            console.error("[QR] TIMEOUT: element tidak ditemukan.");
        }

    }, 500);
});
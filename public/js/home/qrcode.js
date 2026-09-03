/**
 * QR Code Scanner — PKKMB Narotama 2026
 * public/js/home/qrcode.js
 *
 * Html5Qrcode langsung + dropdown pilih kamera.
 */

var scanner = null;
var processed = false;
var starting = false;


// ======================================================
// MULAI KAMERA BERDASARKAN ID
// ======================================================

function startCamera(cameraId) {

    if (scanner || starting) {
        return;
    }

    var reader = document.getElementById("reader");

    if (!reader) {
        return;
    }

    starting = true;
    processed = false;

    console.log("[QR] MULAI KAMERA:", cameraId);

    scanner = new Html5Qrcode("reader");

    scanner.start(
        cameraId,
        {
            fps: 10,
            qrbox: { width: 250, height: 250 },
            aspectRatio: 1.0
        },
        function (decodedText) {

            if (processed) {
                return;
            }

            processed = true;

            console.log("[QR] BERHASIL BACA:", decodedText);

            var codeField = document.getElementById("code-field");
            var form = document.getElementById("kirim-presensi");

            if (codeField) {
                codeField.value = decodedText;
            }

            scanner.stop()
                .then(function () {
                    return scanner.clear();
                })
                .then(function () {
                    scanner = null;
                    starting = false;
                    if (form) form.submit();
                })
                .catch(function () {
                    scanner = null;
                    starting = false;
                    if (form) form.submit();
                });
        },
        function () {
            // error scan diabaikan
        }
    )
        .then(function () {
            starting = false;
            console.log("[QR] KAMERA BERHASIL DIMULAI");
        })
        .catch(function (error) {
            starting = false;
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
            console.log("[QR] KAMERA DIHENTIKAN");
            scanner = null;
            starting = false;
            processed = false;
        })
        .catch(function () {
            scanner = null;
            starting = false;
            processed = false;
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
                console.log("[QR] KAMERA LAMA DIHENTIKAN");
                scanner = null;
                starting = false;
                processed = false;
                startCamera(cameraId);
            })
            .catch(function () {
                scanner = null;
                starting = false;
                processed = false;
                startCamera(cameraId);
            });
    } else {
        startCamera(cameraId);
    }
}


// ======================================================
// BUAT UI PILIH KAMERA
// ======================================================

function buildCameraUI(cameras) {

    var reader = document.getElementById("reader");

    if (!reader) {
        return;
    }

    // Bersihkan area reader
    reader.innerHTML = "";

    // Container untuk dropdown
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

    // Dropdown select
    var select = document.createElement("select");
    select.id = "qr-camera-select";
    select.style.cssText =
        "width: 100%; max-width: 400px; padding: 10px 12px; " +
        "font-size: 14px; border-radius: 8px; border: 1px solid #444; " +
        "background: #1a1a2e; color: #f0f0f0; cursor: pointer; " +
        "outline: none;";

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

    // Sisipkan di atas reader
    reader.parentNode.insertBefore(container, reader);

    // Event: user memilih kamera
    select.addEventListener("change", function () {
        var selectedId = this.value;

        if (!selectedId) {
            return;
        }

        console.log("[QR] KAMERA DIPILIH:", selectedId);

        switchCamera(selectedId);
    });

    // Jika hanya ada 1 kamera, langsung gunakan
    if (cameras.length === 1) {

        select.value = cameras[0].id;

        console.log(
            "[QR] HANYA 1 KAMERA, LANGSUNG DIGUNAKAN:",
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
        console.error("[QR] Library Html5Qrcode TIDAK TERLOAD");
        return;
    }

    console.log("[QR] MENCARI KAMERA...");

    Html5Qrcode.getCameras()
        .then(function (cameras) {

            console.log("[QR] KAMERA DITEMUKAN:", cameras);

            if (!cameras || cameras.length === 0) {
                console.error("[QR] TIDAK ADA KAMERA");
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
            console.error("[QR] TIMEOUT: #reader/#scannerModal tidak ditemukan");
        }

    }, 500);
});
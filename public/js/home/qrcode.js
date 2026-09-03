/**
 * QR Code Scanner — PKKMB Narotama 2026
 * public/js/home/qrcode.js
 *
 * Flowbite modal. Html5Qrcode langsung.
 * Trigger: click pada tombol data-modal-toggle="scannerModal".
 * Tidak menggunakan Bootstrap event atau MutationObserver.
 */

var scanner = null;
var starting = false;
var scanProcessed = false;
var initialized = false;


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

    console.log("[QR] CODE FIELD TERISI:", codeField.value);

    if (!scanner) {
        form.submit();
        return;
    }

    scanner.stop()
        .then(function () {
            console.log("[QR] Scanner dihentikan.");
            return scanner.clear();
        })
        .then(function () {
            scanner = null;
            starting = false;
            console.log("[QR] SUBMIT PRESENSI OTOMATIS");
            form.submit();
        })
        .catch(function (error) {
            console.error("[QR] Error stop scanner:", error);
            scanner = null;
            starting = false;
            form.submit();
        });
}


// ======================================================
// ERROR SCAN (diabaikan)
// ======================================================

function onScanError() {
    // Sengaja kosong agar console tidak penuh
}


// ======================================================
// MULAI KAMERA
// ======================================================

function startCamera(cameraId) {

    if (scanner || starting) {
        return;
    }

    var reader = document.getElementById("reader");

    if (!reader) {
        console.error("[QR] #reader tidak ditemukan.");
        return;
    }

    if (typeof Html5Qrcode === "undefined") {
        console.error("[QR] Library Html5Qrcode tidak terload.");
        return;
    }

    starting = true;
    scanProcessed = false;

    console.log("[QR] KAMERA DIPILIH:", cameraId);
    console.log("[QR] SCANNER START");

    scanner = new Html5Qrcode("reader", {
        formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
        verbose: false
    });

    scanner.start(
        cameraId,
        {
            fps: 15,

            qrbox: function (viewfinderWidth, viewfinderHeight) {
                var size = Math.min(
                    viewfinderWidth * 0.85,
                    viewfinderHeight * 0.85,
                    450
                );
                return {
                    width: Math.floor(size),
                    height: Math.floor(size)
                };
            },

            aspectRatio: 1.0,
            disableFlip: false,

            videoConstraints: {
                facingMode: { ideal: "environment" },
                width: { ideal: 1920 },
                height: { ideal: 1080 }
            },

            experimentalFeatures: {
                useBarCodeDetectorIfSupported: false
            }
        },
        onScanSuccess,
        onScanError
    )
        .then(function () {
            starting = false;
            console.log("[QR] SCANNER AKTIF");
        })
        .catch(function (error) {
            starting = false;
            scanner = null;
            console.error("[QR] SCANNER GAGAL:", error);
        });
}


// ======================================================
// STOP KAMERA
// ======================================================

function stopScanner() {

    if (!scanner) {
        return;
    }

    scanner.stop()
        .then(function () {
            return scanner.clear();
        })
        .then(function () {
            console.log("[QR] Scanner dihentikan.");
            scanner = null;
            starting = false;
            scanProcessed = false;
        })
        .catch(function () {
            scanner = null;
            starting = false;
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
                scanner = null;
                starting = false;
                scanProcessed = false;
                startCamera(cameraId);
            })
            .catch(function () {
                scanner = null;
                starting = false;
                scanProcessed = false;
                startCamera(cameraId);
            });
    } else {
        startCamera(cameraId);
    }
}


// ======================================================
// BUAT DROPDOWN KAMERA
// ======================================================

function buildCameraUI(cameras) {

    var reader = document.getElementById("reader");

    if (!reader) {
        return;
    }

    // Bersihkan dropdown lama jika ada
    var oldSelector = document.getElementById("qr-camera-selector");
    if (oldSelector) {
        oldSelector.remove();
    }

    reader.innerHTML = "";

    var container = document.createElement("div");
    container.id = "qr-camera-selector";
    container.style.cssText =
        "padding: 16px; text-align: center; font-family: sans-serif;";

    var label = document.createElement("label");
    label.textContent = "Pilih Kamera";
    label.setAttribute("for", "qr-camera-select");
    label.style.cssText =
        "display: block; margin-bottom: 8px; font-weight: bold; " +
        "font-size: 14px; color: #f0f0f0;";
    container.appendChild(label);

    var select = document.createElement("select");
    select.id = "qr-camera-select";
    select.style.cssText =
        "width: 100%; max-width: 400px; padding: 10px 12px; " +
        "font-size: 14px; border-radius: 8px; border: 1px solid #444; " +
        "background: #1a1a2e; color: #f0f0f0; cursor: pointer; outline: none;";

    var defaultOption = document.createElement("option");
    defaultOption.value = "";
    defaultOption.textContent = "-- Pilih Kamera --";
    defaultOption.disabled = true;
    defaultOption.selected = true;
    select.appendChild(defaultOption);

    for (var i = 0; i < cameras.length; i++) {
        var option = document.createElement("option");
        option.value = cameras[i].id;
        option.textContent = cameras[i].label || ("Kamera " + (i + 1));
        select.appendChild(option);
    }

    container.appendChild(select);
    reader.parentNode.insertBefore(container, reader);

    select.addEventListener("change", function () {
        var selectedId = this.value;
        if (!selectedId) return;
        switchCamera(selectedId);
    });

    // Jika hanya 1 kamera, langsung gunakan
    if (cameras.length === 1) {
        select.value = cameras[0].id;
        console.log("[QR] Hanya 1 kamera, langsung digunakan.");
        startCamera(cameras[0].id);
    }
}


// ======================================================
// INISIALISASI: PERMISSION → GET CAMERAS → BUILD UI
// ======================================================

function initScanner() {

    if (initialized) {
        return;
    }

    initialized = true;

    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.error("[QR] Browser tidak mendukung akses kamera.");
        initialized = false;
        return;
    }

    if (typeof Html5Qrcode === "undefined") {
        console.error("[QR] Library Html5Qrcode tidak terload.");
        initialized = false;
        return;
    }

    console.log("[QR] MEMINTA PERMISSION KAMERA");

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {

            console.log("[QR] PERMISSION KAMERA BERHASIL");

            // Stop stream dummy, Html5Qrcode akan buat sendiri
            stream.getTracks().forEach(function (track) {
                track.stop();
            });

            return Html5Qrcode.getCameras();
        })
        .then(function (cameras) {

            console.log("[QR] KAMERA DITEMUKAN:", cameras);

            if (!cameras || cameras.length === 0) {
                console.error("[QR] KAMERA TIDAK DITEMUKAN");
                initialized = false;
                return;
            }

            buildCameraUI(cameras);
        })
        .catch(function (error) {
            console.error("[QR] PERMISSION GAGAL:", error);
            initialized = false;
        });
}


// ======================================================
// EVENT: KLIK TOMBOL SCANNER (FLOWBITE)
// ======================================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("[QR] SCRIPT AKTIF");

    // Tombol buka modal scanner
    document.addEventListener("click", function (event) {

        var button = event.target.closest(
            '[data-modal-toggle="scannerModal"]'
        );

        if (!button) {
            return;
        }

        console.log("[QR] TOMBOL SCANNER DIKLIK");

        // Tunggu Flowbite selesai membuka modal
        setTimeout(function () {
            initScanner();
        }, 500);
    });

    // Tombol tutup modal scanner
    document.addEventListener("click", function (event) {

        var hideButton = event.target.closest(
            '[data-modal-hide="scannerModal"]'
        );

        if (!hideButton) {
            return;
        }

        console.log("[QR] TOMBOL TUTUP SCANNER DIKLIK");

        stopScanner();

        // Reset agar bisa init ulang saat modal dibuka kembali
        initialized = false;

        // Bersihkan dropdown
        var selector = document.getElementById("qr-camera-selector");
        if (selector) {
            selector.remove();
        }
    });

});
/**
 * QR Code Scanner — PKKMB Narotama 2026
 * public/js/home/qrcode.js
 *
 * Implementasi Final & Robust untuk Decoding QR.
 * Menggunakan getUserMedia untuk permission awal.
 * Disable BarcodeDetector Android (harus html5-qrcode decoder).
 */

var scanner = null;
var starting = false;
var scanProcessed = false;


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

    console.log("[QR] Code field terisi:", codeField.value);

    scanner.stop()
        .then(function () {
            console.log("[QR] Kamera dihentikan.");
            return scanner.clear();
        })
        .then(function () {
            scanner = null;
            console.log("[QR] Mengirim presensi otomatis.");
            form.submit();
        })
        .catch(function (error) {
            console.error("[QR] Gagal menghentikan scanner:", error);
            scanner = null;
            // Tetap submit agar presensi tidak putus
            form.submit();
        });
}


// ======================================================
// ERROR SCAN (Sengaja kosong agar console bersih)
// ======================================================

function onScanError(errorMessage) {
    // Tidak dilog per frame
}


// ======================================================
// MULAI KAMERA BERDASARKAN ID
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

    console.log("[QR] Scanner mulai");
    console.log("[QR] Kamera dipilih:", cameraId);

    // Pastikan formatsToSupport dilempar di config global Html5Qrcode
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
            disableFlip: false,
            experimentalFeatures: {
                useBarCodeDetectorIfSupported: false // Wajib false khusus untuk case HP tertentu
            }
        },
        onScanSuccess,
        onScanError
    )
        .then(function () {
            starting = false;
            console.log("[QR] Scanner berhasil aktif");
        })
        .catch(function (error) {
            starting = false;
            scanner = null;
            console.error("[QR] Scanner gagal:", error);
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
            starting = false;
            scanProcessed = false;
        })
        .catch(function (error) {
            console.error("[QR] Gagal stop kamera:", error);
            scanner = null;
            starting = false;
            scanProcessed = false;
        });
}


// ======================================================
// GANTI KAMERA & UI DROPDOWN
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


function buildCameraUI(cameras) {

    var reader = document.getElementById("reader");

    if (!reader) {
        return;
    }

    // Bersihkan reader
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

    // Event select ganti kamera
    select.addEventListener("change", function () {
        var selectedId = this.value;

        if (!selectedId) {
            return;
        }

        switchCamera(selectedId);
    });

    // Jika kamera cuma 1
    if (cameras.length === 1) {
        select.value = cameras[0].id;
        console.log("[QR] Hanya 1 kamera, langsung digunakan.");
        startCamera(cameras[0].id);
    }
}


// ======================================================
// INISIALISASI AWAL (PERMISSION & GET CAMERAS)
// ======================================================

function initScannerFlow() {

    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        console.error("[QR] Browser tidak mendukung akses kamera.");
        return;
    }

    console.log("[QR] Meminta permission kamera");

    // 1. Tembak permintaan getUserMedia kamera terlebih dahulu
    navigator.mediaDevices.getUserMedia({
        video: true
    })
        .then(function (stream) {

            console.log("[QR] Permission kamera berhasil");

            // Matikan track dummy karena kita serahkan pembacaan ke Html5Qrcode
            stream.getTracks().forEach(function (track) {
                track.stop();
            });

            // 2. Load Html5Qrcode cameras
            return Html5Qrcode.getCameras();
        })
        .then(function (cameras) {

            console.log("[QR] Daftar kamera:", cameras);

            if (!cameras || cameras.length === 0) {
                console.error("[QR] Kamera tidak ditemukan");
                return;
            }

            buildCameraUI(cameras);
        })
        .catch(function (error) {
            console.error("[QR] Permission kamera gagal:", error);
        });
}


// ======================================================
// EVENT LISTENER MODAL BOOTSTRAP / FLOWBITE
// ======================================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("[QR] SCRIPT AKTIF");

    var modal = document.getElementById("scannerModal");

    if (!modal) {
        console.error("[QR] #scannerModal tidak ditemukan.");
        return;
    }

    // A: Handle Bootstrap Event
    modal.addEventListener("shown.bs.modal", function () {
        console.log("[QR] Modal scanner terbuka");
        setTimeout(function () {
            initScannerFlow();
        }, 500);
    });

    modal.addEventListener("hidden.bs.modal", function () {
        console.log("[QR] Modal scanner tertutup");
        stopCamera();
    });

    // B: Fallback Flowbite Event (berdasarkan atribut class hidden)
    var observer = new MutationObserver(function () {
        var isHidden = modal.classList.contains("hidden");

        if (!isHidden) {
            console.log("[QR] Modal scanner terbuka (fallback)");
            setTimeout(function () {
                initScannerFlow();
            }, 500);
        } else {
            stopCamera();
        }
    });

    observer.observe(modal, {
        attributes: true,
        attributeFilter: ["class"]
    });

});
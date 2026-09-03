/**
 * QR Code Scanner — PKKMB Narotama 2026
 * public/js/home/qrcode.js
 *
 * Implementasi Final untuk Optimalisasi Decoding QR Padat & Resolusi Tinggi.
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

    if (!codeField || !form) {
        console.error("[QR] Element presensi tidak ditemukan.");
        scanProcessed = false;
        return;
    }

    codeField.value = decodedText;

    console.log("[QR] CODE FIELD:", codeField.value);

    scanner.stop()
        .then(function () {
            return scanner.clear();
        })
        .then(function () {
            scanner = null;
            console.log("[QR] Presensi dikirim otomatis.");
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
// ERROR SCAN
// ======================================================

function onScanError(errorMessage) {
    // Sengaja diabaikan agar console tidak penuh per frame
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
    console.log("[QR] Camera selected:", cameraId);

    scanner = new Html5Qrcode("reader", {
        formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
        verbose: false
    });

    scanner.start(
        cameraId,
        {
            fps: 15,

            // Perbesar ukuran region box decoding agar pixel density terjangkau
            qrbox: function (viewfinderWidth, viewfinderHeight) {
                var size = Math.min(
                    viewfinderWidth * 0.85,
                    viewfinderHeight * 0.65,
                    450
                );
                return {
                    width: Math.floor(size),
                    height: Math.floor(size)
                };
            },

            aspectRatio: 1.0,
            disableFlip: false,

            // Paksa penggunaan HTML5 native decoder
            experimentalFeatures: {
                useBarCodeDetectorIfSupported: false
            },

            // Konfigurasi prioritas resolusi & facing mode
            videoConstraints: {
                facingMode: {
                    ideal: "environment"
                },
                width: {
                    ideal: 1920
                },
                height: {
                    ideal: 1080
                }
            }
        },
        onScanSuccess,
        onScanError
    )
        .then(function () {
            starting = false;
            console.log("[QR] Camera resolution: 1080p target requested");
            console.log("[QR] Scanner started");
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

        if (!selectedId) {
            return;
        }

        switchCamera(selectedId);
    });

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

    navigator.mediaDevices.getUserMedia({
        video: true
    })
        .then(function (stream) {

            console.log("[QR] Permission kamera berhasil");

            stream.getTracks().forEach(function (track) {
                track.stop();
            });

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
// EVENT LISTENER MODAL (FLOWBITE VIA MUTATIONOBSERVER)
// ======================================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("[QR] SCRIPT AKTIF");

    var modal = document.getElementById("scannerModal");

    if (!modal) {
        console.error("[QR] #scannerModal tidak ditemukan.");
        return;
    }

    var initDone = false;

    // Flowbite toggle modal dengan menambah/hapus class "hidden"
    var observer = new MutationObserver(function () {
        var isHidden = modal.classList.contains("hidden");

        if (!isHidden && !initDone) {
            initDone = true;
            console.log("[QR] Modal scanner terbuka");
            setTimeout(function () {
                initScannerFlow();
            }, 500);
        } else if (isHidden && initDone) {
            initDone = false;
            console.log("[QR] Modal scanner tertutup");
            stopCamera();

            // Bersihkan dropdown kamera agar tidak menumpuk saat modal dibuka lagi
            var selector = document.getElementById("qr-camera-selector");
            if (selector) {
                selector.remove();
            }
        }
    });

    observer.observe(modal, {
        attributes: true,
        attributeFilter: ["class"]
    });

});
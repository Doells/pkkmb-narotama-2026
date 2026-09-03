/**
 * QR Code Scanner — PKKMB Narotama 2026
 * File: public/js/home/qrcode.js
 */

let html5QRCodeScanner = null;
let scanProcessed = false;
let scannerStarting = false;

// ============================================================
// QR BERHASIL DIBACA
// ============================================================
function onScanSuccess(decodedText) {
    if (scanProcessed) {
        return;
    }

    scanProcessed = true;

    console.log("[qrcode.js] QR berhasil dibaca:", decodedText);

    const codeField = document.getElementById("code-field");
    const form = document.getElementById("kirim-presensi");

    if (codeField) {
        codeField.value = decodedText;
    } else {
        console.error("[qrcode.js] #code-field tidak ditemukan.");
    }

    if (!html5QRCodeScanner) {
        if (form) {
            form.submit();
        }
        return;
    }

    // Hentikan kamera terlebih dahulu
    html5QRCodeScanner.stop()
        .then(() => {
            console.log("[qrcode.js] Kamera berhasil dihentikan.");

            return html5QRCodeScanner.clear();
        })
        .then(() => {
            console.log("[qrcode.js] Scanner berhasil dibersihkan.");

            html5QRCodeScanner = null;
            scannerStarting = false;

            if (form) {
                form.submit();
            }
        })
        .catch((error) => {
            console.error("[qrcode.js] Gagal menghentikan scanner:", error);

            html5QRCodeScanner = null;
            scannerStarting = false;

            // Tetap submit agar presensi tidak gagal hanya karena
            // proses penghentian kamera bermasalah.
            if (form) {
                form.submit();
            }
        });
}


// ============================================================
// ERROR SAAT SCAN
// ============================================================
function onScanError(errorMessage) {
    // Jangan console.log setiap frame karena akan sangat banyak.
}


// ============================================================
// CARI KAMERA
// ============================================================
function getCameraId() {
    return Html5Qrcode.getCameras()
        .then((cameras) => {

            if (!cameras || cameras.length === 0) {
                throw new Error("KAMERA_TIDAK_DITEMUKAN");
            }

            console.log(
                "[qrcode.js] Kamera ditemukan:",
                cameras
            );

            // Prioritaskan kamera belakang
            const backCamera = cameras.find((camera) => {
                const label = (camera.label || "").toLowerCase();

                return (
                    label.includes("back") ||
                    label.includes("rear") ||
                    label.includes("environment") ||
                    label.includes("belakang")
                );
            });

            if (backCamera) {
                console.log(
                    "[qrcode.js] Menggunakan kamera belakang:",
                    backCamera.label
                );

                return backCamera.id;
            }

            // Kalau kamera belakang tidak ditemukan,
            // gunakan kamera pertama
            console.log(
                "[qrcode.js] Kamera belakang tidak ditemukan."
            );

            console.log(
                "[qrcode.js] Menggunakan kamera:",
                cameras[0].label
            );

            return cameras[0].id;
        });
}


// ============================================================
// MULAI SCANNER
// ============================================================
function startScanner() {

    if (html5QRCodeScanner || scannerStarting) {
        return;
    }

    const reader = document.getElementById("reader");

    if (!reader) {
        console.error(
            "[qrcode.js] Element #reader tidak ditemukan."
        );
        return;
    }

    // Pastikan library tersedia
    if (typeof Html5Qrcode === "undefined") {
        console.error(
            "[qrcode.js] Library Html5Qrcode tidak tersedia."
        );
        return;
    }

    scannerStarting = true;
    scanProcessed = false;

    console.log("[qrcode.js] Mencari kamera...");

    // Bersihkan area scanner
    reader.innerHTML = "";

    getCameraId()
        .then((cameraId) => {

            console.log(
                "[qrcode.js] Memulai kamera..."
            );

            html5QRCodeScanner = new Html5Qrcode("reader");

            return html5QRCodeScanner.start(
                cameraId,
                {
                    fps: 10,

                    qrbox: {
                        width: 250,
                        height: 250
                    },

                    aspectRatio: 1.0
                },
                onScanSuccess,
                onScanError
            );
        })
        .then(() => {

            scannerStarting = false;

            console.log(
                "[qrcode.js] Kamera berhasil dimulai."
            );

        })
        .catch((error) => {

            scannerStarting = false;
            html5QRCodeScanner = null;

            console.error(
                "[qrcode.js] Kamera gagal dimulai:",
                error
            );

            if (
                error &&
                error.message === "KAMERA_TIDAK_DITEMUKAN"
            ) {
                console.error(
                    "[qrcode.js] Kamera tidak ditemukan."
                );
            } else {
                console.error(
                    "[qrcode.js] Izin kamera ditolak atau kamera tidak dapat digunakan."
                );
            }
        });
}


// ============================================================
// STOP SCANNER
// ============================================================
function stopScanner() {

    if (!html5QRCodeScanner) {
        return;
    }

    console.log(
        "[qrcode.js] Menghentikan kamera..."
    );

    html5QRCodeScanner.stop()
        .then(() => {

            console.log(
                "[qrcode.js] Kamera dihentikan."
            );

            return html5QRCodeScanner.clear();
        })
        .then(() => {

            console.log(
                "[qrcode.js] Scanner dibersihkan."
            );

            html5QRCodeScanner = null;
            scannerStarting = false;
            scanProcessed = false;
        })
        .catch((error) => {

            console.error(
                "[qrcode.js] Gagal menghentikan scanner:",
                error
            );

            html5QRCodeScanner = null;
            scannerStarting = false;
            scanProcessed = false;
        });
}


// ============================================================
// MODAL
// ============================================================
document.addEventListener("DOMContentLoaded", function () {

    const scannerModal =
        document.getElementById("scannerModal");

    if (!scannerModal) {
        console.error(
            "[qrcode.js] Element #scannerModal tidak ditemukan."
        );
        return;
    }

    console.log(
        "[qrcode.js] QR scanner script aktif."
    );


    // ========================================================
    // Bootstrap Modal
    // ========================================================
    scannerModal.addEventListener(
        "shown.bs.modal",
        function () {

            console.log(
                "[qrcode.js] Modal scanner terbuka."
            );

            setTimeout(function () {
                startScanner();
            }, 500);
        }
    );


    scannerModal.addEventListener(
        "hidden.bs.modal",
        function () {

            console.log(
                "[qrcode.js] Modal scanner ditutup."
            );

            stopScanner();
        }
    );


    // ========================================================
    // Fallback jika modal menggunakan perubahan class
    // ========================================================
    const observer = new MutationObserver(function () {

        const isHidden =
            scannerModal.classList.contains("hidden");

        if (!isHidden) {

            setTimeout(function () {
                startScanner();
            }, 500);

        } else {

            stopScanner();
        }
    });


    observer.observe(scannerModal, {
        attributes: true,
        attributeFilter: ["class"]
    });

});
/**
 * QR Code Scanner — PKKMB Narotama 2026
 * public/js/home/qrcode.js
 *
 * Pendekatan: Html5Qrcode langsung + polling.
 * Tidak menggunakan Html5QrcodeScanner, Bootstrap events, atau MutationObserver.
 */

let scanner = null;
let starting = false;
let processed = false;

function startScanner() {
    if (scanner || starting) {
        return;
    }

    const reader = document.getElementById("reader");

    if (!reader) {
        return;
    }

    if (typeof Html5Qrcode === "undefined") {
        console.error("[QR] Html5Qrcode TIDAK TERLOAD");
        return;
    }

    starting = true;
    processed = false;

    console.log("[QR] START CAMERA");

    reader.innerHTML = "";

    scanner = new Html5Qrcode("reader");

    Html5Qrcode.getCameras()
        .then(function (cameras) {

            console.log("[QR] CAMERAS:", cameras);

            if (!cameras || cameras.length === 0) {
                throw new Error("Tidak ada kamera ditemukan");
            }

            var cameraId = cameras[0].id;

            var backCamera = cameras.find(function (camera) {
                var label = (camera.label || "").toLowerCase();

                return (
                    label.includes("back") ||
                    label.includes("rear") ||
                    label.includes("environment")
                );
            });

            if (backCamera) {
                cameraId = backCamera.id;
            }

            console.log("[QR] CAMERA ID:", cameraId);

            return scanner.start(
                cameraId,
                {
                    fps: 10,
                    qrbox: {
                        width: 250,
                        height: 250
                    },
                    aspectRatio: 1.0
                },
                function (decodedText) {

                    if (processed) {
                        return;
                    }

                    processed = true;

                    console.log(
                        "[QR] BERHASIL BACA:",
                        decodedText
                    );

                    var codeField =
                        document.getElementById("code-field");

                    var form =
                        document.getElementById("kirim-presensi");

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

                            if (form) {
                                form.submit();
                            }

                        })
                        .catch(function (error) {

                            console.error(
                                "[QR] GAGAL STOP:",
                                error
                            );

                            scanner = null;
                            starting = false;

                            if (form) {
                                form.submit();
                            }
                        });
                },
                function () {
                    // scan error diabaikan
                }
            );
        })
        .then(function () {

            starting = false;

            console.log(
                "[QR] KAMERA BERHASIL DIMULAI"
            );

        })
        .catch(function (error) {

            starting = false;
            scanner = null;

            console.error(
                "[QR] KAMERA GAGAL:",
                error
            );
        });
}

function stopScanner() {

    if (!scanner) {
        return;
    }

    console.log("[QR] STOP CAMERA");

    scanner.stop()
        .then(function () {
            return scanner.clear();
        })
        .then(function () {

            scanner = null;
            starting = false;
            processed = false;

        })
        .catch(function (error) {

            console.error(
                "[QR] STOP ERROR:",
                error
            );

            scanner = null;
            starting = false;
            processed = false;
        });
}


// ======================================================
// POLLING
// ======================================================

document.addEventListener("DOMContentLoaded", function () {

    console.log("[QR] SCRIPT AKTIF");

    var attempts = 0;

    var timer = setInterval(function () {

        attempts++;

        var reader =
            document.getElementById("reader");

        var modal =
            document.getElementById("scannerModal");

        if (reader && modal) {

            console.log(
                "[QR] READER DITEMUKAN"
            );

            clearInterval(timer);

            // Tunggu modal selesai terbuka
            setTimeout(function () {
                startScanner();
            }, 1000);
        }

        // Jangan polling selamanya
        if (attempts >= 20) {

            clearInterval(timer);

            console.error(
                "[QR] #reader tidak ditemukan setelah 20 detik"
            );
        }

    }, 500);
});
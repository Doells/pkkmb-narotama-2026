/**
 * QR Code Scanner — PKKMB Narotama 2026
 * Hanya mengatur scanner kamera dan submit hasil scan.
 */

let scanner = null;
let scanning = false;
let scanProcessed = false;
let selectedCameraId = null;

// ============================================================
// CALLBACK BERHASIL SCAN
// ============================================================

function onScanSuccess(decodedText) {
    if (scanProcessed) return;

    console.log("[QR] ========================================");
    console.log("[QR] QR CODE BERHASIL TERBACA!");
    console.log("[QR] Panjang data:", decodedText.length);
    console.log("[QR] ========================================");

    scanProcessed = true;

    const codeField = document.getElementById("code-field");
    const form = document.getElementById("kirim-presensi");

    if (!codeField || !form) {
        console.error("[QR] Form atau code-field tidak ditemukan.");
        scanProcessed = false;
        return;
    }

    codeField.value = decodedText;

    stopScanner().finally(() => {
        console.log("[QR] Mengirim data presensi...");
        form.submit();
    });
}

// ============================================================
// CALLBACK ERROR SCAN
// ============================================================

function onScanError(errorMessage) {
    // Jangan spam console.
    // QR belum terbaca bukan berarti error aplikasi.
}

// ============================================================
// STOP SCANNER
// ============================================================

async function stopScanner() {
    if (!scanner || !scanning) {
        scanner = null;
        scanning = false;
        return;
    }

    try {
        await scanner.stop();
        console.log("[QR] Scanner dihentikan.");
    } catch (error) {
        console.warn("[QR] Stop scanner:", error);
    }

    scanner = null;
    scanning = false;
}

// ============================================================
// START SCANNER
// ============================================================

async function startScanner() {
    if (scanning) {
        console.log("[QR] Scanner sudah aktif.");
        return;
    }

    const reader = document.getElementById("reader");

    if (!reader) {
        console.error("[QR] Element #reader tidak ditemukan.");
        return;
    }

    if (typeof Html5Qrcode === "undefined") {
        console.error("[QR] Library Html5Qrcode tidak ditemukan.");
        return;
    }

    console.log("[QR] ========================================");
    console.log("[QR] MEMULAI SCANNER");
    console.log("[QR] ========================================");

    scanProcessed = false;

    // Bersihkan tampilan reader
    reader.innerHTML = "";

    try {
        // ----------------------------------------------------
        // Ambil kamera
        // ----------------------------------------------------

        let cameras = await Html5Qrcode.getCameras();

        console.log("[QR] Jumlah kamera:", cameras.length);
        console.log("[QR] Daftar kamera:", cameras);

        if (!cameras || cameras.length === 0) {
            console.error("[QR] Tidak ada kamera.");
            return;
        }

        // Jika sebelumnya sudah memilih kamera
        if (!selectedCameraId) {

            // Prioritaskan kamera belakang / environment
            const backCamera = cameras.find(camera => {
                const label = (camera.label || "").toLowerCase();

                return (
                    label.includes("back") ||
                    label.includes("rear") ||
                    label.includes("environment") ||
                    label.includes("belakang")
                );
            });

            if (backCamera) {
                selectedCameraId = backCamera.id;
            } else {
                // Kalau tidak ada label belakang,
                // gunakan kamera pertama.
                selectedCameraId = cameras[0].id;
            }
        }

        const selectedCamera = cameras.find(
            camera => camera.id === selectedCameraId
        );

        console.log(
            "[QR] Kamera yang digunakan:",
            selectedCamera ? selectedCamera.label : selectedCameraId
        );

        // ----------------------------------------------------
        // Buat scanner
        // ----------------------------------------------------

        scanner = new Html5Qrcode("reader");

        // Ukuran QR box dibuat besar karena QR sangat padat
        const readerWidth = reader.clientWidth || 500;

        const qrBoxSize = Math.min(
            Math.max(Math.floor(readerWidth * 0.75), 280),
            500
        );

        console.log("[QR] QR Box:", qrBoxSize);

        const config = {
            fps: 30,

            qrbox: {
                width: qrBoxSize,
                height: qrBoxSize
            },

            aspectRatio: 1.0,

            formatsToSupport: [
                Html5QrcodeSupportedFormats.QR_CODE
            ],

            disableFlip: false,

            videoConstraints: {
                width: {
                    ideal: 1920
                },
                height: {
                    ideal: 1080
                }
            }
        };

        // ----------------------------------------------------
        // Mulai kamera
        // ----------------------------------------------------

        await scanner.start(
            selectedCameraId,
            config,
            onScanSuccess,
            onScanError
        );

        scanning = true;

        console.log("[QR] ========================================");
        console.log("[QR] SCANNER AKTIF");
        console.log("[QR] Kamera:", selectedCameraId);
        console.log("[QR] FPS: 30");
        console.log("[QR] Resolusi target: 1920x1080");
        console.log("[QR] QR Box:", qrBoxSize);
        console.log("[QR] SIAP MEMBACA QR");
        console.log("[QR] ========================================");

    } catch (error) {

        console.error("[QR] GAGAL MEMULAI SCANNER:", error);

        scanner = null;
        scanning = false;
    }
}

// ============================================================
// PILIH KAMERA
// ============================================================

async function loadCameras() {
    try {
        if (typeof Html5Qrcode === "undefined") {
            console.error("[QR] Html5Qrcode belum tersedia.");
            return;
        }

        const cameras = await Html5Qrcode.getCameras();

        console.log("[QR] Kamera tersedia:", cameras);

        if (!cameras.length) return;

        // Cari kamera belakang
        const backCamera = cameras.find(camera => {
            const label = (camera.label || "").toLowerCase();

            return (
                label.includes("back") ||
                label.includes("rear") ||
                label.includes("environment") ||
                label.includes("belakang")
            );
        });

        selectedCameraId = backCamera
            ? backCamera.id
            : cameras[0].id;

    } catch (error) {
        console.error("[QR] Gagal mendapatkan daftar kamera:", error);
    }
}

// ============================================================
// MODAL
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    const scannerModal =
        document.getElementById("scannerModal");

    if (!scannerModal) {
        console.error(
            "[QR] Element #scannerModal tidak ditemukan."
        );
        return;
    }

    console.log("[QR] qrcode.js berhasil dimuat.");

    // --------------------------------------------------------
    // Bootstrap modal
    // --------------------------------------------------------

    scannerModal.addEventListener(
        "shown.bs.modal",
        async function () {

            console.log("[QR] MODAL SCANNER DIBUKA");

            await new Promise(resolve =>
                setTimeout(resolve, 500)
            );

            await loadCameras();
            await startScanner();
        }
    );

    scannerModal.addEventListener(
        "hidden.bs.modal",
        async function () {

            console.log("[QR] MODAL SCANNER DITUTUP");

            await stopScanner();
        }
    );

    // --------------------------------------------------------
    // Fallback untuk modal yang menggunakan class hidden
    // --------------------------------------------------------

    let previousHiddenState =
        scannerModal.classList.contains("hidden");

    const observer = new MutationObserver(async function () {

        const isHidden =
            scannerModal.classList.contains("hidden");

        // Modal baru dibuka
        if (previousHiddenState && !isHidden) {

            console.log("[QR] MODAL DIBUKA (fallback)");

            await new Promise(resolve =>
                setTimeout(resolve, 500)
            );

            await loadCameras();
            await startScanner();
        }

        // Modal ditutup
        if (!previousHiddenState && isHidden) {

            console.log("[QR] MODAL DITUTUP (fallback)");

            await stopScanner();
        }

        previousHiddenState = isHidden;
    });

    observer.observe(scannerModal, {
        attributes: true,
        attributeFilter: ["class"]
    });
});
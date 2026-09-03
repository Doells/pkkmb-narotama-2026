/**
 * QR Code Scanner — PKKMB Narotama 2026
 * ZXing Decoder Engine Optimized for Dense QR Payload
 */

let codeReader = null;
let scanning = false;
let scanProcessed = false;
let selectedCameraId = null;

// ============================================================
// CALLBACK BERHASIL SCAN
// ============================================================

function onScanSuccess(decodedText) {
    if (scanProcessed) return;
    if (!decodedText) return;

    console.log("[QR] ========================================");
    console.log("[QR] QR BERHASIL TERBACA");
    console.log("[QR] PANJANG DATA:", decodedText.length);
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
        console.log("[QR] SUBMIT PRESENSI");
        form.submit();
    });
}

// ============================================================
// STOP SCANNER
// ============================================================

async function stopScanner() {
    if (!codeReader || !scanning) {
        scanning = false;
        return;
    }

    try {
        codeReader.reset(); // Menghentikan decoding loop dan mematikan stream
        console.log("[QR] Scanner dihentikan.");
    } catch (error) {
        console.warn("[QR] Stop scanner peringatan:", error);
    }

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

    if (typeof ZXing === "undefined") {
        console.error("[QR] Library ZXing tidak ditemukan.");
        return;
    }

    console.log("[QR] ========================================");
    console.log("[QR] DECODER ALTERNATIF DIMUAT");
    console.log("[QR] ========================================");

    scanProcessed = false;

    // Bersihkan tampilan reader dan sisipkan tag video untuk ZXing
    reader.innerHTML = "";
    const videoElement = document.createElement("video");
    videoElement.id = "zxing-video";

    // Tweak CSS agar sesuai dengan kotak reader (tidak crop terlalu ekstrem)
    videoElement.style.width = "100%";
    videoElement.style.height = "100%";
    videoElement.style.objectFit = "cover";
    videoElement.setAttribute("autoplay", "true");
    videoElement.setAttribute("muted", "true");
    videoElement.setAttribute("playsinline", "true");

    reader.appendChild(videoElement);

    if (!codeReader) {
        codeReader = new ZXing.BrowserQRCodeReader();
    }

    try {
        // Jika kamera belum dipilih, pilih default
        if (!selectedCameraId) {
            await loadCameras();
        }

        console.log("[QR] Mengaktifkan kamera:", selectedCameraId);

        // Langsung menembak stream ke element video serta loop reading QR
        codeReader.decodeFromVideoDevice(selectedCameraId, videoElement, (result, err) => {
            if (result) {
                onScanSuccess(result.getText());
            }
            if (err && !(err instanceof ZXing.NotFoundException)) {
                // Jangan log NotFoundException karena lumrah saat frame tidak ada QR.
            }
        });

        scanning = true;

        console.log("[QR] ========================================");
        console.log("[QR] KAMERA AKTIF");
        console.log("[QR] MENCARI QR...");
        console.log("[QR] ========================================");

    } catch (error) {
        console.error("[QR] GAGAL MEMULAI SCANNER:", error);
        scanning = false;
    }
}

// ============================================================
// PILIH KAMERA UI & LOGIC
// ============================================================

function switchCamera(cameraId) {
    if (!cameraId) return;

    console.log("[QR] Mengalihkan kamera ke:", cameraId);
    selectedCameraId = cameraId;

    if (scanning) {
        stopScanner().then(() => {
            scanProcessed = false;
            startScanner();
        });
    } else {
        scanProcessed = false;
        startScanner();
    }
}

function createCameraSelector(cameras) {
    const reader = document.getElementById("reader");
    if (!reader) return;

    const oldSelector = document.getElementById("qr-camera-selector");
    if (oldSelector) {
        oldSelector.remove();
    }

    const container = document.createElement("div");
    container.id = "qr-camera-selector";
    container.style.cssText = "width:100%;padding:12px 0;text-align:center;";

    const label = document.createElement("div");
    label.textContent = "Pilih Kamera";
    label.style.cssText = "font-size:16px;font-weight:600;margin-bottom:8px;color:#fff;";
    container.appendChild(label);

    const select = document.createElement("select");
    select.id = "qr-camera-select";
    select.style.cssText = "width:90%;max-width:450px;padding:12px;border-radius:10px;font-size:16px;background:#1a1a2e;color:#fff;border:1px solid rgba(255,255,255,.3);";

    cameras.forEach((camera, index) => {
        const option = document.createElement("option");
        // Gunakan deviceId untuk ZXing
        option.value = camera.deviceId;
        option.textContent = camera.label || ("Kamera " + (index + 1));
        select.appendChild(option);
    });

    container.appendChild(select);
    reader.parentNode.insertBefore(container, reader);

    select.value = selectedCameraId;

    select.addEventListener("change", function () {
        switchCamera(this.value);
    });
}

// ============================================================
// LOAD CAMERAS
// ============================================================

async function loadCameras() {
    try {
        if (typeof ZXing === "undefined") {
            console.error("[QR] ZXing belum tersedia.");
            return;
        }

        if (!codeReader) {
            codeReader = new ZXing.BrowserQRCodeReader();
        }

        // ZXing menggunakan standar WebRTC navigator.mediaDevices.enumerateDevices
        const cameras = await codeReader.getVideoInputDevices();

        console.log("[QR] Jumlah kamera ditemukan:", cameras.length);
        console.log("[QR] Kamera tersedia:", cameras);

        if (!cameras || cameras.length === 0) return;

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

        // Simpan state
        selectedCameraId = backCamera ? backCamera.deviceId : cameras[0].deviceId;

        // Buat DOM selector
        createCameraSelector(cameras);

    } catch (error) {
        console.error("[QR] Gagal mendapatkan daftar kamera:", error);
    }
}

// ============================================================
// MODAL (Flowbite) & INITIALIZATION
// ============================================================

document.addEventListener("DOMContentLoaded", function () {

    const scannerModal = document.getElementById("scannerModal");

    if (!scannerModal) {
        console.error("[QR] Element #scannerModal tidak ditemukan.");
        return;
    }

    console.log("[QR] ZXing script handler berhasil dimuat.");

    let previousHiddenState = scannerModal.classList.contains("hidden");

    // Mengandalkan observer class "hidden" karena Flowbite tidak memicu events
    const observer = new MutationObserver(async function () {
        const isHidden = scannerModal.classList.contains("hidden");

        // Modal baru dibuka
        if (previousHiddenState && !isHidden) {
            console.log("[QR] MODAL DIBUKA (fallback)");

            // Tunggu modal stabil di mata user
            await new Promise(resolve => setTimeout(resolve, 500));

            // Permission check native sebelum dilacak oleh ZXing
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: { ideal: "environment" } } });
                stream.getTracks().forEach(track => track.stop());
            } catch (err) {
                console.warn("[QR] Auto permission denied, ZXing mungkin gagal mengambil frame:", err);
            }

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
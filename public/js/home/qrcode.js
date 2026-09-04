/**
 * QR Code Scanner — PKKMB Narotama 2026
 * ZXing — Optimized for Dense / Long QR Payload
 */

let codeReader = null;
let scanning = false;
let scanProcessed = false;
let selectedCameraId = null;

function onScanSuccess(decodedText) {
    if (scanProcessed || !decodedText) return;

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

async function stopScanner() {
    if (!codeReader || !scanning) {
        scanning = false;
        return;
    }

    try {
        codeReader.reset();
        console.log("[QR] Scanner dihentikan.");
    } catch (error) {
        console.warn("[QR] Stop scanner peringatan:", error);
    }

    scanning = false;
}

function createCodeReader() {
    if (typeof ZXing === "undefined") {
        console.error("[QR] Library ZXing tidak ditemukan.");
        return null;
    }

    try {
        const hints = new Map();

        if (ZXing.DecodeHintType && ZXing.BarcodeFormat) {
            hints.set(
                ZXing.DecodeHintType.POSSIBLE_FORMATS,
                [ZXing.BarcodeFormat.QR_CODE]
            );

            hints.set(
                ZXing.DecodeHintType.TRY_HARDER,
                true
            );
        }

        return new ZXing.BrowserQRCodeReader(hints, 100, 150);
    } catch (error) {
        console.warn("[QR] Gagal membuat reader dengan hints:", error);
        return new ZXing.BrowserQRCodeReader();
    }
}

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
    console.log("[QR] ZXING DENSE QR DECODER");
    console.log("[QR] TRY_HARDER AKTIF");
    console.log("[QR] ========================================");

    scanProcessed = false;

    const oldVideo = document.getElementById("zxing-video");
    if (oldVideo) oldVideo.remove();

    const videoElement = document.createElement("video");
    videoElement.id = "zxing-video";
    videoElement.style.width = "100%";
    videoElement.style.height = "100%";
    videoElement.style.objectFit = "contain";
    videoElement.style.background = "#000";
    videoElement.setAttribute("autoplay", "true");
    videoElement.setAttribute("muted", "true");
    videoElement.setAttribute("playsinline", "true");

    reader.appendChild(videoElement);

    if (!codeReader) {
        codeReader = createCodeReader();
    }

    if (!codeReader) return;

    try {
        if (!selectedCameraId) {
            await loadCameras();
        }

        if (!selectedCameraId) {
            console.error("[QR] Tidak ada kamera yang tersedia.");
            return;
        }

        console.log("[QR] Mengaktifkan kamera:", selectedCameraId);

        codeReader.decodeFromVideoDevice(
            selectedCameraId,
            videoElement,
            (result, err) => {
                if (result) {
                    onScanSuccess(result.getText());
                    return;
                }

                if (
                    err &&
                    ZXing.NotFoundException &&
                    !(err instanceof ZXing.NotFoundException)
                ) {
                    console.debug("[QR] Frame belum berhasil dibaca:", err);
                }
            }
        );

        scanning = true;

        console.log("[QR] ========================================");
        console.log("[QR] KAMERA AKTIF");
        console.log("[QR] MENCARI QR...");
        console.log("[QR] TRY_HARDER: AKTIF");
        console.log("[QR] ========================================");
    } catch (error) {
        console.error("[QR] GAGAL MEMULAI SCANNER:", error);
        scanning = false;
    }
}

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
    if (oldSelector) oldSelector.remove();

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
        option.value = camera.deviceId;
        option.textContent = camera.label || ("Kamera " + (index + 1));
        select.appendChild(option);
    });

    container.appendChild(select);
    reader.parentNode.insertBefore(container, reader);

    if (selectedCameraId) {
        select.value = selectedCameraId;
    }

    select.addEventListener("change", function () {
        switchCamera(this.value);
    });
}

async function loadCameras() {
    try {
        if (typeof ZXing === "undefined") {
            console.error("[QR] ZXing belum tersedia.");
            return;
        }

        if (!codeReader) {
            codeReader = createCodeReader();
        }

        if (!codeReader) return;

        const cameras = await codeReader.getVideoInputDevices();

        console.log("[QR] Jumlah kamera ditemukan:", cameras.length);
        console.log("[QR] Kamera tersedia:", cameras);

        if (!cameras || cameras.length === 0) {
            console.error("[QR] Kamera tidak ditemukan.");
            return;
        }

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
            ? backCamera.deviceId
            : cameras[0].deviceId;

        console.log("[QR] Kamera terpilih:", selectedCameraId);
        createCameraSelector(cameras);
    } catch (error) {
        console.error("[QR] Gagal mendapatkan daftar kamera:", error);
    }
}

async function requestCameraPermission() {
    if (
        !navigator.mediaDevices ||
        !navigator.mediaDevices.getUserMedia
    ) {
        console.warn("[QR] Browser tidak mendukung getUserMedia.");
        return;
    }

    try {
        const stream = await navigator.mediaDevices.getUserMedia({
            video: {
                facingMode: { ideal: "environment" },
                width: { ideal: 1920, min: 1280 },
                height: { ideal: 1080, min: 720 }
            },
            audio: false
        });

        stream.getTracks().forEach(track => track.stop());

        console.log("[QR] Permission kamera berhasil.");
    } catch (error) {
        console.warn("[QR] Permission kamera:", error);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const scannerModal = document.getElementById("scannerModal");

    if (!scannerModal) {
        console.error("[QR] Element #scannerModal tidak ditemukan.");
        return;
    }

    console.log("[QR] ZXing script handler berhasil dimuat.");

    let previousHiddenState = scannerModal.classList.contains("hidden");

    const observer = new MutationObserver(async function () {
        const isHidden = scannerModal.classList.contains("hidden");

        if (previousHiddenState && !isHidden) {
            console.log("[QR] MODAL DIBUKA");

            await new Promise(resolve => setTimeout(resolve, 500));
            await requestCameraPermission();

            scanProcessed = false;
            selectedCameraId = null;

            if (codeReader) {
                try {
                    codeReader.reset();
                } catch (e) {
                    console.warn("[QR] Reset reader:", e);
                }
                codeReader = null;
            }

            await loadCameras();
            await startScanner();
        }

        if (!previousHiddenState && isHidden) {
            console.log("[QR] MODAL DITUTUP");
            await stopScanner();
        }

        previousHiddenState = isHidden;
    });

    observer.observe(scannerModal, {
        attributes: true,
        attributeFilter: ["class"]
    });
});

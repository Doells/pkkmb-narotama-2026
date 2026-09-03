/**
 * QR Code Scanner — PKKMB Narotama 2026
 * File: public/js/home/qrcode.js
 *
 * Loaded as <script type="module"> after html5-qrcode.min.js.
 * Only touches: #scannerModal, #reader, #code-field, #kirim-presensi.
 */

let html5QRCodeScanner = null;
let scanProcessed = false; // flag agar onScanSuccess hanya diproses 1x per sesi

// ── Callback sukses ─────────────────────────────────────────
function onScanSuccess(decodedText) {
    // Cegah pemrosesan ganda jika kamera membaca QR berulang kali
    if (scanProcessed) return;
    scanProcessed = true;

    const codeField = document.getElementById("code-field");
    const form = document.getElementById("kirim-presensi");

    if (codeField) {
        codeField.value = decodedText;
    }

    if (html5QRCodeScanner) {
        html5QRCodeScanner.clear()
            .then(() => {
                html5QRCodeScanner = null;
                if (form) form.submit();
            })
            .catch(() => {
                html5QRCodeScanner = null;
                if (form) form.submit();
            });
    } else if (form) {
        form.submit();
    }
}

// ── Callback error (sengaja dibiarkan kosong) ───────────────
function onScanError() {
    // Tidak ditampilkan agar console tidak penuh
}

// ── Start scanner ───────────────────────────────────────────
function startScanner() {
    // Jangan buat lebih dari satu instance
    if (html5QRCodeScanner) return;

    const reader = document.getElementById("reader");
    if (!reader) {
        console.error("[qrcode.js] Element #reader tidak ditemukan.");
        return;
    }

    if (typeof Html5QrcodeScanner === "undefined") {
        console.error("[qrcode.js] Library Html5QrcodeScanner belum tersedia.");
        return;
    }

    // Reset state
    reader.innerHTML = "";
    scanProcessed = false;

    html5QRCodeScanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: { width: 250, height: 250 },
            formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
            rememberLastUsedCamera: true
        },
        /* verbose= */ false
    );

    html5QRCodeScanner.render(onScanSuccess, onScanError);
}

// ── Stop scanner ────────────────────────────────────────────
function stopScanner() {
    if (!html5QRCodeScanner) return;

    html5QRCodeScanner.clear()
        .then(() => { html5QRCodeScanner = null; })
        .catch(() => { html5QRCodeScanner = null; });
}

// ── Bootstrap & fallback binding ────────────────────────────
document.addEventListener("DOMContentLoaded", function () {
    const scannerModal = document.getElementById("scannerModal");

    if (!scannerModal) {
        console.error("[qrcode.js] Element #scannerModal tidak ditemukan.");
        return;
    }

    // 1) Primary: Bootstrap modal events
    scannerModal.addEventListener("shown.bs.modal", function () {
        setTimeout(startScanner, 300);
    });

    scannerModal.addEventListener("hidden.bs.modal", function () {
        stopScanner();
    });

    // 2) Fallback: MutationObserver untuk sistem modal non-Bootstrap (Flowbite)
    const observer = new MutationObserver(function () {
        if (!scannerModal.classList.contains("hidden")) {
            setTimeout(startScanner, 300);
        } else {
            stopScanner();
        }
    });

    observer.observe(scannerModal, {
        attributes: true,
        attributeFilter: ["class"]
    });
});
let html5QRCodeScanner = null;

// Function ketika QR berhasil terbaca
function onScanSuccess(decodedText, decodedResult) {
    const codeField = document.getElementById("code-field");

    if (codeField) {
        codeField.value = decodedText;
    }

    const form = document.getElementById("kirim-presensi");

    if (html5QRCodeScanner) {
        html5QRCodeScanner.clear()
            .then(() => {
                console.log("Scanner berhasil dihentikan setelah QR terbaca.");

                if (form) {
                    form.submit();
                }
            })
            .catch((error) => {
                console.error("Gagal menghentikan scanner:", error);

                if (form) {
                    form.submit();
                }
            });
    } else {
        if (form) {
            form.submit();
        }
    }
}

// Error scan - sengaja tidak ditampilkan terus menerus
function onScanError(errorMessage) {
    // Tidak perlu melakukan apa-apa
}

// Mulai scanner
function startScanner() {
    // Jangan membuat scanner lebih dari satu
    if (html5QRCodeScanner) {
        return;
    }

    const reader = document.getElementById("reader");

    if (!reader) {
        console.error("Element #reader tidak ditemukan.");
        return;
    }

    // Pastikan library html5-qrcode sudah tersedia
    if (
        typeof window.Html5QrcodeScanner === "undefined" ||
        typeof window.Html5QrcodeSupportedFormats === "undefined"
    ) {
        console.error("Library html5-qrcode belum tersedia.");
        return;
    }

    console.log("Memulai QR Scanner...");

    // Bersihkan reader terlebih dahulu
    reader.innerHTML = "";

    html5QRCodeScanner = new window.Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            },
            formatsToSupport: [
                window.Html5QrcodeSupportedFormats.QR_CODE
            ],
            rememberLastUsedCamera: true
        },
        false
    );

    html5QRCodeScanner.render(
        onScanSuccess,
        onScanError
    );

    console.log("QR Scanner berhasil dibuat.");
}

// Hentikan scanner
function stopScanner() {
    if (!html5QRCodeScanner) {
        return;
    }

    html5QRCodeScanner.clear()
        .then(() => {
            console.log("QR Scanner berhasil dihentikan.");
            html5QRCodeScanner = null;
        })
        .catch((error) => {
            console.error("Gagal menghentikan scanner:", error);
            html5QRCodeScanner = null;
        });
}

document.addEventListener("DOMContentLoaded", function () {

    const scannerModal = document.getElementById("scannerModal");

    if (!scannerModal) {
        console.error("Element #scannerModal tidak ditemukan.");
        return;
    }

    console.log("QR Code script aktif.");

    /*
     * Bootstrap event
     */
    scannerModal.addEventListener("shown.bs.modal", function () {
        console.log("Modal scanner terbuka.");
        setTimeout(function () {
            startScanner();
        }, 300);
    });

    scannerModal.addEventListener("hidden.bs.modal", function () {
        console.log("Modal scanner ditutup.");
        stopScanner();
    });

    /*
     * Fallback:
     * Pantau perubahan class modal.
     * Ini menjaga kompatibilitas dengan sistem modal yang sekarang.
     */
    const observer = new MutationObserver(function () {
        if (!scannerModal.classList.contains("hidden")) {
            setTimeout(function () {
                startScanner();
            }, 300);
        } else {
            stopScanner();
        }
    });

    observer.observe(scannerModal, {
        attributes: true,
        attributeFilter: ["class"]
    });

});
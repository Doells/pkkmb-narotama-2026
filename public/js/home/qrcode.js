let html5QRCodeScanner = null;

// Function yang dieksekusi ketika scanner berhasil membaca QR Code
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
            .catch(error => {
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

// Mulai scanner
function startScanner() {
    // Jangan buat scanner baru kalau sudah ada
    if (html5QRCodeScanner) {
        return;
    }

    const reader = document.getElementById("reader");

    if (!reader) {
        console.error("Element #reader tidak ditemukan.");
        return;
    }

    // Bersihkan isi reader terlebih dahulu
    reader.innerHTML = "";

    html5QRCodeScanner = new Html5QrcodeScanner(
        "reader",
        {
            fps: 10,
            qrbox: {
                width: 250,
                height: 250
            },
            formatsToSupport: [
                Html5QrcodeSupportedFormats.QR_CODE
            ],
            rememberLastUsedCamera: true,
            supportedScanTypes: [
                Html5QrcodeScanType.SCAN_TYPE_CAMERA
            ]
        },
        false
    );

    html5QRCodeScanner.render(
        onScanSuccess,
        onScanError
    );

    console.log("QR Scanner berhasil dimulai.");
}

// Error saat proses scan
function onScanError(errorMessage) {
    // Jangan tampilkan error scan terus-menerus ke console
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

            const reader = document.getElementById("reader");

            if (reader) {
                reader.innerHTML = "";
            }
        })
        .catch(error => {
            console.error("Gagal menghentikan QR Scanner:", error);
            html5QRCodeScanner = null;
        });
}

document.addEventListener("DOMContentLoaded", function () {
    const scannerModal = document.getElementById("scannerModal");

    if (!scannerModal) {
        console.error("Element #scannerModal tidak ditemukan.");
        return;
    }

    // Bootstrap Modal: ketika modal sudah terbuka
    scannerModal.addEventListener("shown.bs.modal", function () {
        console.log("Modal scanner dibuka.");
        startScanner();
    });

    // Bootstrap Modal: ketika modal sudah ditutup
    scannerModal.addEventListener("hidden.bs.modal", function () {
        console.log("Modal scanner ditutup.");
        stopScanner();
    });
});
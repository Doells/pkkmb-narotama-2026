let html5QRCodeScanner = null;

// Function yang dieksekusi ketika scanner berhasil membaca QR Code
function onScanSuccess(decodedText, decodedResult) {
    // Mendapatkan elemen form dan field
    const codeField = document.getElementById("code-field");
    
    if (codeField) {
        // Isi field dengan data dari QR code
        codeField.value = decodedText;
    }
    
    // Membersihkan scan area (hentikan kamera) ketika sudah berhasil
    if (html5QRCodeScanner) {
        html5QRCodeScanner.clear().then(() => {
            console.log("Scanner berhasil dihentikan setelah QR terbaca.");
            // Submit form setelah scanner berhenti sepenuhnya
            document.getElementById('kirim-presensi').submit();
        }).catch(error => {
            console.error("Gagal menghentikan scanner: ", error);
            // Fallback: tetap submit jika gagal stop
            document.getElementById('kirim-presensi').submit();
        });
    } else {
        document.getElementById('kirim-presensi').submit();
    }
}

// Fungsi untuk memulai dan membuat objek scanner baru jika belum ada
function startScanner() {
    if (!html5QRCodeScanner) {
        html5QRCodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: { width: 250, height: 250 },
                formatsToSupport: [Html5QrcodeSupportedFormats.QR_CODE],
                rememberLastUsedCamera: true,
                supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
            },
            /* verbose= */ false
        );
        html5QRCodeScanner.render(onScanSuccess);
    }
}

// Fungsi untuk menghentikan dan mereset memori scanner
function stopScanner() {
    if (html5QRCodeScanner) {
        html5QRCodeScanner.clear().then(() => {
            html5QRCodeScanner = null;
        }).catch(err => {
            console.error("Gagal menghentikan scanner secara paksa:", err);
            html5QRCodeScanner = null;
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const scannerModal = document.getElementById('scannerModal');
    
    if (scannerModal) {
        // Obeservasi modul scanner, eksekusi jika kelas HTML-nya berubah
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === "class") {
                    const classList = scannerModal.classList;
                    // Jika modal tidak memiliki kelas 'hidden' (berarti sedang terbuka)
                    if (!classList.contains("hidden")) {
                        startScanner();
                    } else {
                        // Jika modal sedang ditutup, matikan kamera
                        stopScanner();
                    }
                }
            });
        });

        observer.observe(scannerModal, {
            attributes: true
        });
    }
});

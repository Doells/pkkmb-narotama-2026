/**
 * QR CODE SCANNER - PKKMB NAROTAMA 2026
 *
 * HANYA untuk:
 * - kamera
 * - pilihan kamera
 * - decoding QR
 * - submit presensi otomatis
 *
 * Tidak mengubah Blade, Controller, Route, Database, atau Nginx.
 */

var scanner = null;
var selectedCameraId = null;
var isStarting = false;
var isScanning = false;
var scanProcessed = false;
var modalOpened = false;


// ============================================================
// ELEMENT
// ============================================================

function getReader() {
    return document.getElementById("reader");
}

function getForm() {
    return document.getElementById("kirim-presensi");
}

function getCodeField() {
    return document.getElementById("code-field");
}


// ============================================================
// QR BERHASIL DIBACA
// ============================================================

function onScanSuccess(decodedText, decodedResult) {

    if (scanProcessed) {
        return;
    }

    if (!decodedText) {
        return;
    }

    scanProcessed = true;

    console.log("[QR] ==================================");
    console.log("[QR] QR TERDETEKSI");
    console.log("[QR] Panjang data:", decodedText.length);
    console.log("[QR] Data:", decodedText);
    console.log("[QR] ==================================");

    var codeField = getCodeField();
    var form = getForm();

    if (!codeField) {
        console.error("[QR] #code-field tidak ditemukan.");
        scanProcessed = false;
        return;
    }

    if (!form) {
        console.error("[QR] #kirim-presensi tidak ditemukan.");
        scanProcessed = false;
        return;
    }

    // Masukkan hasil scan ke input
    codeField.value = decodedText;

    console.log("[QR] CODE FIELD TERISI");
    console.log("[QR] Panjang:", codeField.value.length);

    // Hentikan kamera terlebih dahulu
    stopScanner()
        .then(function () {

            console.log("[QR] Scanner berhenti.");
            console.log("[QR] SUBMIT PRESENSI OTOMATIS");

            // Submit ke checkDataQrCode
            form.submit();

        })
        .catch(function (error) {

            console.error("[QR] Gagal menghentikan scanner:", error);

            // Tetap submit supaya presensi tidak gagal
            form.submit();
        });
}


// ============================================================
// ERROR SCAN
// ============================================================

function onScanError(errorMessage) {
    // Jangan console.log setiap frame.
}


// ============================================================
// STOP SCANNER
// ============================================================

function stopScanner() {

    return new Promise(function (resolve) {

        if (!scanner) {
            isScanning = false;
            isStarting = false;
            resolve();
            return;
        }

        var currentScanner = scanner;

        scanner = null;
        isScanning = false;
        isStarting = false;

        currentScanner.stop()
            .then(function () {

                console.log("[QR] Kamera dihentikan.");

                return currentScanner.clear();

            })
            .then(function () {

                resolve();

            })
            .catch(function (error) {

                console.warn(
                    "[QR] Stop/clear scanner:",
                    error
                );

                resolve();
            });
    });
}


// ============================================================
// MULAI SCANNER
// ============================================================

function startScanner(cameraId) {

    if (isStarting || isScanning) {
        console.log("[QR] Scanner sudah berjalan.");
        return;
    }

    var reader = getReader();

    if (!reader) {
        console.error("[QR] #reader tidak ditemukan.");
        return;
    }

    if (typeof Html5Qrcode === "undefined") {

        console.error(
            "[QR] Html5Qrcode tidak tersedia."
        );

        return;
    }

    if (!cameraId) {
        console.error("[QR] Camera ID kosong.");
        return;
    }

    isStarting = true;
    scanProcessed = false;

    selectedCameraId = cameraId;

    // Bersihkan isi reader
    reader.innerHTML = "";

    console.log("[QR] ==================================");
    console.log("[QR] MEMULAI SCANNER");
    console.log("[QR] Camera ID:", cameraId);
    console.log("[QR] ==================================");

    var newScanner;

    try {

        newScanner = new Html5Qrcode("reader", {
            verbose: false,

            formatsToSupport: [
                Html5QrcodeSupportedFormats.QR_CODE
            ]
        });

    } catch (error) {

        isStarting = false;

        console.error(
            "[QR] Gagal membuat scanner:",
            error
        );

        return;
    }

    scanner = newScanner;

    /*
     * QR kamu sangat padat.
     *
     * Kita menggunakan area scan yang besar supaya
     * decoder mendapatkan pixel sebanyak mungkin.
     */
    var config = {

        fps: 20,

        qrbox: function (
            viewfinderWidth,
            viewfinderHeight
        ) {

            var size = Math.min(
                viewfinderWidth * 0.90,
                viewfinderHeight * 0.90,
                500
            );

            return {
                width: Math.floor(size),
                height: Math.floor(size)
            };
        },

        aspectRatio: 1.0,

        disableFlip: false,

        /*
         * Jangan menggunakan BarcodeDetector browser.
         * Gunakan decoder internal html5-qrcode.
         */
        experimentalFeatures: {
            useBarCodeDetectorIfSupported: false
        },

        videoConstraints: {

            facingMode: {
                ideal: "environment"
            },

            width: {
                ideal: 1920,
                min: 640
            },

            height: {
                ideal: 1080,
                min: 480
            },

            frameRate: {
                ideal: 30,
                min: 15
            }
        }
    };


    newScanner.start(
        cameraId,
        config,
        onScanSuccess,
        onScanError
    )
        .then(function () {

            isStarting = false;
            isScanning = true;

            console.log("[QR] ==================================");
            console.log("[QR] SCANNER AKTIF");
            console.log("[QR] Kamera:", cameraId);
            console.log("[QR] FPS: 20");
            console.log("[QR] Resolusi target: 1920x1080");
            console.log("[QR] Decoder: html5-qrcode");
            console.log("[QR] SIAP MEMBACA QR");
            console.log("[QR] ==================================");

        })
        .catch(function (error) {

            isStarting = false;
            isScanning = false;
            scanner = null;

            console.error(
                "[QR] SCANNER GAGAL START:",
                error
            );

            /*
             * Jika constraint kamera terlalu ketat pada device tertentu,
             * lakukan fallback ke konfigurasi sederhana.
             */
            console.log(
                "[QR] Mencoba fallback kamera..."
            );

            startScannerFallback(cameraId);
        });
}


// ============================================================
// FALLBACK SCANNER
// ============================================================

function startScannerFallback(cameraId) {

    if (isStarting || isScanning) {
        return;
    }

    var reader = getReader();

    if (!reader) {
        return;
    }

    if (typeof Html5Qrcode === "undefined") {
        return;
    }

    isStarting = true;
    scanProcessed = false;

    reader.innerHTML = "";

    var fallbackScanner;

    try {

        fallbackScanner = new Html5Qrcode(
            "reader",
            {
                verbose: false,

                formatsToSupport: [
                    Html5QrcodeSupportedFormats.QR_CODE
                ]
            }
        );

    } catch (error) {

        isStarting = false;

        console.error(
            "[QR] Fallback gagal membuat scanner:",
            error
        );

        return;
    }

    scanner = fallbackScanner;

    fallbackScanner.start(
        cameraId,
        {
            fps: 15,

            qrbox: function (
                viewfinderWidth,
                viewfinderHeight
            ) {

                var size = Math.min(
                    viewfinderWidth * 0.90,
                    viewfinderHeight * 0.90,
                    450
                );

                return {
                    width: Math.floor(size),
                    height: Math.floor(size)
                };
            },

            aspectRatio: 1.0,

            disableFlip: false
        },

        onScanSuccess,
        onScanError

    )
        .then(function () {

            isStarting = false;
            isScanning = true;

            console.log(
                "[QR] FALLBACK SCANNER AKTIF"
            );

        })
        .catch(function (error) {

            isStarting = false;
            isScanning = false;
            scanner = null;

            console.error(
                "[QR] FALLBACK SCANNER GAGAL:",
                error
            );
        });
}


// ============================================================
// PILIH KAMERA
// ============================================================

function switchCamera(cameraId) {

    if (!cameraId) {
        return;
    }

    console.log(
        "[QR] Kamera dipilih:",
        cameraId
    );

    selectedCameraId = cameraId;

    if (scanner) {

        stopScanner()
            .then(function () {

                scanProcessed = false;

                startScanner(cameraId);

            });

    } else {

        scanProcessed = false;

        startScanner(cameraId);
    }
}


// ============================================================
// UI PILIH KAMERA
// ============================================================

function createCameraSelector(cameras) {

    var reader = getReader();

    if (!reader) {
        return;
    }

    /*
     * Hapus selector lama.
     */
    var oldSelector =
        document.getElementById("qr-camera-selector");

    if (oldSelector) {
        oldSelector.remove();
    }


    var container =
        document.createElement("div");

    container.id =
        "qr-camera-selector";

    container.style.cssText =
        "width:100%;padding:12px 0;text-align:center;";


    var label =
        document.createElement("div");

    label.textContent =
        "Pilih Kamera";

    label.style.cssText =
        "font-size:16px;font-weight:600;margin-bottom:8px;color:#fff;";

    container.appendChild(label);


    var select =
        document.createElement("select");

    select.id =
        "qr-camera-select";

    select.style.cssText =
        "width:90%;max-width:450px;padding:12px;" +
        "border-radius:10px;" +
        "font-size:16px;" +
        "background:#123047;" +
        "color:#fff;" +
        "border:1px solid rgba(255,255,255,.3);";


    for (
        var i = 0;
        i < cameras.length;
        i++
    ) {

        var option =
            document.createElement("option");

        option.value =
            cameras[i].id;

        option.textContent =
            cameras[i].label ||
            ("Kamera " + (i + 1));

        select.appendChild(option);
    }


    container.appendChild(select);


    /*
     * Masukkan selector SEBELUM #reader.
     */
    reader.parentNode.insertBefore(
        container,
        reader
    );


    select.addEventListener(
        "change",
        function () {

            var cameraId =
                this.value;

            switchCamera(cameraId);
        }
    );


    /*
     * Prioritaskan kamera belakang.
     */
    var backCamera = null;

    for (
        var j = 0;
        j < cameras.length;
        j++
    ) {

        var labelText =
            (
                cameras[j].label || ""
            ).toLowerCase();

        if (
            labelText.indexOf("back") !== -1 ||
            labelText.indexOf("rear") !== -1 ||
            labelText.indexOf("belakang") !== -1 ||
            labelText.indexOf("environment") !== -1
        ) {

            backCamera =
                cameras[j];

            break;
        }
    }


    if (backCamera) {

        selectedCameraId =
            backCamera.id;

        select.value =
            backCamera.id;

        console.log(
            "[QR] Kamera belakang ditemukan:",
            backCamera.label
        );

        startScanner(
            backCamera.id
        );

    } else {

        selectedCameraId =
            cameras[0].id;

        select.value =
            cameras[0].id;

        console.log(
            "[QR] Kamera default:",
            cameras[0].label
        );

        startScanner(
            cameras[0].id
        );
    }
}


// ============================================================
// MINTA PERMISSION + DETEKSI KAMERA
// ============================================================

function initializeCamera() {

    if (!navigator.mediaDevices ||
        !navigator.mediaDevices.getUserMedia) {

        console.error(
            "[QR] Browser tidak mendukung kamera."
        );

        return;
    }

    console.log(
        "[QR] MEMINTA PERMISSION KAMERA"
    );


    navigator.mediaDevices.getUserMedia({
        video: {
            facingMode: {
                ideal: "environment"
            }
        },
        audio: false
    })

        .then(function (stream) {

            console.log(
                "[QR] PERMISSION KAMERA BERHASIL"
            );

            /*
             * Permission sudah diberikan.
             * Matikan stream sementara karena Html5Qrcode
             * akan membuat stream sendiri.
             */
            stream.getTracks().forEach(
                function (track) {
                    track.stop();
                }
            );


            return Html5Qrcode.getCameras();
        })

        .then(function (cameras) {

            console.log(
                "[QR] JUMLAH KAMERA:",
                cameras.length
            );

            console.log(
                "[QR] DAFTAR KAMERA:",
                cameras
            );


            if (!cameras ||
                cameras.length === 0) {

                console.error(
                    "[QR] KAMERA TIDAK DITEMUKAN"
                );

                return;
            }


            createCameraSelector(
                cameras
            );
        })

        .catch(function (error) {

            console.error(
                "[QR] PERMISSION KAMERA GAGAL:",
                error
            );

            alert(
                "Kamera tidak dapat digunakan. " +
                "Pastikan izin kamera untuk website ini sudah diaktifkan."
            );
        });
}


// ============================================================
// TOMBOL SCANNER FLOWBITE
// ============================================================

document.addEventListener(
    "DOMContentLoaded",
    function () {

        console.log(
            "[QR] SCRIPT AKTIF"
        );


        /*
         * Event delegated.
         *
         * Tidak peduli tombol dibuat oleh Blade,
         * Livewire, atau elemen dinamis.
         */
        document.addEventListener(
            "click",
            function (event) {

                var button =
                    event.target.closest(
                        '[data-modal-toggle="scannerModal"]'
                    );


                if (!button) {
                    return;
                }


                console.log(
                    "[QR] TOMBOL SCANNER DIKLIK"
                );


                /*
                 * Jangan langsung start karena Flowbite
                 * masih dalam proses membuka modal.
                 */
                setTimeout(
                    function () {

                        var modal =
                            document.getElementById(
                                "scannerModal"
                            );

                        if (!modal) {

                            console.error(
                                "[QR] #scannerModal tidak ditemukan."
                            );

                            return;
                        }


                        modalOpened = true;


                        /*
                         * Pastikan #reader ada.
                         */
                        var reader =
                            document.getElementById(
                                "reader"
                            );

                        if (!reader) {

                            console.error(
                                "[QR] #reader tidak ditemukan."
                            );

                            return;
                        }


                        initializeCamera();

                    },
                    700
                );
            }
        );


        /*
         * Tombol tutup Flowbite.
         */
        document.addEventListener(
            "click",
            function (event) {

                var closeButton =
                    event.target.closest(
                        '[data-modal-hide="scannerModal"]'
                    );


                if (!closeButton) {
                    return;
                }


                console.log(
                    "[QR] MODAL DITUTUP"
                );


                modalOpened = false;
                scanProcessed = false;

                stopScanner();
            }
        );


        /*
         * Fallback:
         * Jika user menekan tombol X biasa di dalam modal,
         * stop scanner ketika modal menjadi hidden.
         */
        var modal =
            document.getElementById(
                "scannerModal"
            );


        if (modal) {

            var observer =
                new MutationObserver(
                    function () {

                        if (
                            modal.classList.contains(
                                "hidden"
                            )
                        ) {

                            if (scanner) {

                                console.log(
                                    "[QR] MODAL HIDDEN - STOP CAMERA"
                                );

                                stopScanner();
                            }

                            modalOpened = false;
                        }
                    }
                );


            observer.observe(
                modal,
                {
                    attributes: true,
                    attributeFilter: ["class"]
                }
            );
        }

    }
);
(function () {
    'use strict';

    console.log('[QR] qrcode.js loaded');

    let qrScanner = null;
    let scanning = false;

    const KEY_B64 = 'c+R8LGJChPU+1zoZ1BgJmqaivpKn/Ly/RsapBKI55fY=';
    const IV_B64 = 'UHvpaORuxDGSu+LQuPZmSg==';

    function base64ToBytes(base64) {
        const binary = atob(base64);
        const bytes = new Uint8Array(binary.length);

        for (let i = 0; i < binary.length; i++) {
            bytes[i] = binary.charCodeAt(i);
        }

        return bytes;
    }

    async function decryptQR(encryptedText) {
        const key = await crypto.subtle.importKey(
            'raw',
            base64ToBytes(KEY_B64),
            'AES-CBC',
            false,
            ['decrypt']
        );

        const decrypted = await crypto.subtle.decrypt(
            {
                name: 'AES-CBC',
                iv: base64ToBytes(IV_B64)
            },
            key,
            base64ToBytes(encryptedText)
        );

        return new TextDecoder().decode(decrypted);
    }

    async function handleScan(raw) {
        if (scanning) return;

        scanning = true;

        console.log('[QR] TERDETEKSI:', raw);

        try {
            const decrypted = await decryptQR(raw);

            console.log('[QR] DECRYPT:', decrypted);

            const payload = JSON.parse(decrypted);

            if (!payload.id || !payload.expired_date) {
                throw new Error('Format QR tidak valid');
            }

            const expiredDate = new Date(payload.expired_date);

            if (Number.isNaN(expiredDate.getTime())) {
                throw new Error('Tanggal QR tidak valid');
            }

            if (expiredDate.getTime() <= Date.now()) {
                alert('QR Code sudah kadaluarsa. Silakan buat QR baru.');
                scanning = false;
                return;
            }

            const button = document.querySelector(
                '[data-is-enter="1"][data-presensi-code]'
            );

            if (!button) {
                throw new Error('Tombol presensi tidak ditemukan');
            }

            const presensiCode =
                button.getAttribute('data-presensi-code');

            if (!presensiCode) {
                throw new Error('Kode presensi tidak ditemukan');
            }

            const finalCode =
                payload.id + '-' + presensiCode;

            console.log('[QR] User ID:', payload.id);
            console.log('[QR] Presensi Code:', presensiCode);
            console.log('[QR] QR Code final:', finalCode);

            const input =
                document.getElementById('code-field');

            if (!input) {
                throw new Error('code-field tidak ditemukan');
            }

            input.value = finalCode;

            stopScanner();

            const form =
                document.getElementById('kirim-presensi');

            if (!form) {
                throw new Error('Form presensi tidak ditemukan');
            }

            console.log('[QR] SUBMIT PRESENSI');

            form.submit();

        } catch (error) {
            console.error('[QR] Gagal:', error);

            alert(
                'QR Code tidak dikenali atau tidak valid.'
            );

            scanning = false;
        }
    }

    async function startScanner() {
        console.log('[QR] START SCANNER');

        if (qrScanner) {
            console.log('[QR] Scanner sudah aktif');
            return;
        }

        if (typeof QrScanner === 'undefined') {
            console.error(
                '[QR] Library QrScanner tidak ditemukan'
            );
            return;
        }

        const reader =
            document.getElementById('reader');

        if (!reader) {
            console.error(
                '[QR] #reader tidak ditemukan'
            );
            return;
        }

        reader.innerHTML = '';

        const video =
            document.createElement('video');

        video.id = 'qr-camera-video';

        video.setAttribute(
            'playsinline',
            ''
        );

        video.setAttribute(
            'muted',
            ''
        );

        video.autoplay = true;

        video.style.width = '100%';
        video.style.maxWidth = '500px';
        video.style.display = 'block';
        video.style.margin = '0 auto';
        video.style.borderRadius = '12px';

        reader.appendChild(video);

        QrScanner.WORKER_PATH =
            window.location.origin +
            '/js/vendor/qr-scanner/qr-scanner-worker.min.js';

        console.log(
            '[QR] WORKER:',
            QrScanner.WORKER_PATH
        );

        try {
            qrScanner = new QrScanner(
                video,
                function (result) {

                    const raw =
                        typeof result === 'string'
                            ? result
                            : result.data;

                    handleScan(raw);
                },
                {
                    preferredCamera: 'environment',
                    maxScansPerSecond: 10,
                    highlightScanRegion: true,
                    highlightCodeOutline: true,
                    returnDetailedScanResult: true,
                    onDecodeError: function () {}
                }
            );

            await qrScanner.start();

            console.log(
                '[QR] KAMERA BERHASIL AKTIF'
            );

        } catch (error) {

            console.error(
                '[QR] KAMERA GAGAL:',
                error
            );

            qrScanner = null;

            reader.innerHTML =
                '<div style="padding:20px;text-align:center;color:white;">' +
                'Kamera tidak dapat diakses.<br>' +
                'Pastikan izin kamera sudah diberikan.' +
                '</div>';
        }
    }

    function stopScanner() {
        console.log('[QR] STOP SCANNER');

        if (qrScanner) {
            try {
                qrScanner.stop();
            } catch (e) {}

            try {
                qrScanner.destroy();
            } catch (e) {}

            qrScanner = null;
        }

        scanning = false;
    }

    function setupScanner() {
        console.log('[QR] SETUP SCANNER');

        const modal =
            document.getElementById('scannerModal');

        if (!modal) {
            console.error(
                '[QR] scannerModal tidak ditemukan'
            );
            return;
        }

        document.addEventListener(
            'click',
            function (event) {

                const target =
                    event.target.closest(
                        '[data-modal-target="scannerModal"], ' +
                        '[data-modal-toggle="scannerModal"]'
                    );

                if (target) {

                    console.log(
                        '[QR] TOMBOL SCAN DIKLIK'
                    );

                    setTimeout(
                        startScanner,
                        700
                    );
                }
            }
        );

        const observer =
            new MutationObserver(
                function () {

                    if (
                        !modal.classList.contains(
                            'hidden'
                        )
                    ) {

                        console.log(
                            '[QR] MODAL TERBUKA'
                        );

                        setTimeout(
                            startScanner,
                            500
                        );

                    } else {

                        stopScanner();
                    }
                }
            );

        observer.observe(
            modal,
            {
                attributes: true,
                attributeFilter: ['class']
            }
        );

        console.log(
            '[QR] OBSERVER AKTIF'
        );
    }

    if (
        document.readyState ===
        'loading'
    ) {

        document.addEventListener(
            'DOMContentLoaded',
            setupScanner
        );

    } else {

        setupScanner();
    }

})();

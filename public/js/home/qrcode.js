/**
 * QR Code Scanner - PKKMB Narotama 2026
 * Compatible dengan mekanisme pkkmb.indrianto.cloud
 *
 * - qr-scanner 1.4.2
 * - AES-256-CBC
 * - Payload QR:
 *   {"id":"USER_ID","expired_date":"ISO_DATE"}
 * - Submit:
 *   qr_code = "<userId>-<presensiCode>"
 */

(function () {
    'use strict';

    const KEY_B64 =
        'c+R8LGJChPU+1zoZ1BgJmqaivpKn/Ly/RsapBKI55fY=';

    const IV_B64 =
        'UHvpaORuxDGSu+LQuPZmSg==';

    let scanner = null;
    let scanning = false;
    let scanProcessed = false;

    function b64ToBytes(b64) {
        const binary = atob(b64);

        const bytes = new Uint8Array(binary.length);

        for (let i = 0; i < binary.length; i++) {
            bytes[i] = binary.charCodeAt(i);
        }

        return bytes;
    }

    async function getKey() {
        return crypto.subtle.importKey(
            'raw',
            b64ToBytes(KEY_B64),
            'AES-CBC',
            false,
            ['decrypt']
        );
    }

    async function decryptQrPayload(scanned) {
        const key = await getKey();

        const encrypted = b64ToBytes(scanned.trim());

        const decrypted = await crypto.subtle.decrypt(
            {
                name: 'AES-CBC',
                iv: b64ToBytes(IV_B64)
            },
            key,
            encrypted
        );

        const text =
            new TextDecoder().decode(decrypted);

        return JSON.parse(text);
    }

    function isExpired(expiredDate) {
        const time = Date.parse(expiredDate);

        if (!Number.isFinite(time)) {
            return true;
        }

        return time <= Date.now();
    }

    async function handleScan(raw) {
        if (scanProcessed || !raw) {
            return;
        }

        scanProcessed = true;

        try {
            console.log('[QR] ===============================');
            console.log('[QR] QR BERHASIL TERBACA');
            console.log('[QR] PANJANG DATA:', raw.length);
            console.log('[QR] ===============================');

            /*
             * Dekripsi QR menggunakan AES-256-CBC
             */
            const payload =
                await decryptQrPayload(raw);

            console.log('[QR] Payload berhasil didekripsi:', payload);

            /*
             * Validasi payload
             */
            if (
                !payload ||
                !payload.id ||
                !payload.expired_date
            ) {
                throw new Error(
                    'Payload QR tidak valid'
                );
            }

            /*
             * Cek masa berlaku QR
             */
            if (isExpired(payload.expired_date)) {

                console.warn(
                    '[QR] QR SUDAH KADALUARSA'
                );

                alert(
                    'Kode QR sudah kadaluarsa, minta peserta membuat ulang.'
                );

                scanProcessed = false;

                return;
            }

            /*
             * Ambil kode sesi presensi
             */
            const button =
                document.querySelector(
                    '[data-presensi-code][data-is-enter="1"]'
                );

            const codeField =
                document.getElementById(
                    'code-field'
                );

            const form =
                document.getElementById(
                    'kirim-presensi'
                );

            if (
                !button ||
                !codeField ||
                !form
            ) {
                throw new Error(
                    'Elemen presensi tidak ditemukan'
                );
            }

            const presensiCode =
                button.dataset.presensiCode;

            if (!presensiCode) {
                throw new Error(
                    'Kode sesi presensi tidak ditemukan'
                );
            }

            /*
             * FORMAT SAMA DENGAN
             * pkkmb.indrianto.cloud
             *
             * <userId>-<presensiCode>
             */
            const qrCode =
                `${payload.id}-${presensiCode}`;

            codeField.value = qrCode;

            console.log(
                '[QR] USER ID:',
                payload.id
            );

            console.log(
                '[QR] PRESENSI CODE:',
                presensiCode
            );

            console.log(
                '[QR] QR CODE:',
                qrCode
            );

            /*
             * Matikan scanner
             */
            await stopScanner();

            /*
             * Kirim ke Laravel
             */
            console.log(
                '[QR] SUBMIT PRESENSI...'
            );

            form.submit();

        } catch (error) {

            console.error(
                '[QR] QR TIDAK DIKENALI / GAGAL DEKRIPSI:',
                error
            );

            alert(
                'Kode QR tidak dikenali atau tidak sesuai. Pastikan menggunakan QR Presensi peserta.'
            );

            scanProcessed = false;
        }
    }

    async function startScanner() {

        if (scanning) {
            return;
        }

        const reader =
            document.getElementById(
                'reader'
            );

        if (!reader) {

            console.error(
                '[QR] Element #reader tidak ditemukan.'
            );

            return;
        }

        /*
         * Pastikan library qr-scanner tersedia
         */
        if (
            typeof QrScanner ===
            'undefined'
        ) {

            console.error(
                '[QR] Library qr-scanner tidak ditemukan.'
            );

            alert(
                'Scanner QR belum termuat. Silakan refresh halaman.'
            );

            return;
        }

        try {

            scanning = true;
            scanProcessed = false;

            /*
             * Bersihkan scanner lama
             */
            reader.innerHTML = '';

            /*
             * Buat video kamera
             */
            const video =
                document.createElement(
                    'video'
                );

            video.id =
                'qr-camera-video';

            video.setAttribute(
                'autoplay',
                ''
            );

            video.setAttribute(
                'muted',
                ''
            );

            video.setAttribute(
                'playsinline',
                ''
            );

            video.style.width =
                '100%';

            video.style.height =
                '100%';

            video.style.objectFit =
                'cover';

            video.style.borderRadius =
                '12px';

            video.style.background =
                '#000';

            reader.appendChild(
                video
            );

            /*
             * Worker qr-scanner
             */
            QrScanner.WORKER_PATH =
                'https://cdn.jsdelivr.net/npm/qr-scanner@1.4.2/qr-scanner-worker.min.js';

            /*
             * Buat scanner
             */
            scanner =
                new QrScanner(
                    video,

                    result => {

                        const raw =
                            typeof result ===
                                'string'
                                ? result
                                : result.data;

                        handleScan(raw);
                    },

                    {
                        preferredCamera:
                            'environment',

                        maxScansPerSecond:
                            20,

                        highlightScanRegion:
                            true,

                        highlightCodeOutline:
                            true,

                        returnDetailedScanResult:
                            true,

                        onDecodeError:
                            () => { }
                    }
                );

            /*
             * Mulai kamera
             */
            await scanner.start();

            console.log(
                '[QR] ==============================='
            );

            console.log(
                '[QR] QR-SCANNER AKTIF'
            );

            console.log(
                '[QR] MENCARI QR...'
            );

            console.log(
                '[QR] AES-256-CBC READY'
            );

            console.log(
                '[QR] ==============================='
            );

        } catch (error) {

            console.error(
                '[QR] GAGAL MEMULAI SCANNER:',
                error
            );

            scanning = false;

            alert(
                'Kamera tidak dapat diakses. Buka halaman melalui Safari atau Chrome.'
            );
        }
    }

    async function stopScanner() {

        if (scanner) {

            try {

                scanner.stop();

                scanner.destroy();

                console.log(
                    '[QR] Scanner dihentikan.'
                );

            } catch (error) {

                console.warn(
                    '[QR] Gagal menghentikan scanner:',
                    error
                );
            }
        }

        scanner = null;

        scanning = false;
    }

    function watchModal() {

        const modal =
            document.getElementById(
                'scannerModal'
            );

        if (!modal) {

            console.warn(
                '[QR] #scannerModal belum ditemukan.'
            );

            return;
        }

        /*
         * Flowbite menggunakan class hidden
         * untuk membuka/menutup modal.
         */
        const observer =
            new MutationObserver(
                () => {

                    const hidden =
                        modal.classList.contains(
                            'hidden'
                        );

                    if (!hidden) {

                        setTimeout(
                            () => {
                                startScanner();
                            },
                            150
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
                attributeFilter: [
                    'class'
                ]
            }
        );

        /*
         * Bootstrap compatibility
         */
        modal.addEventListener(
            'shown.bs.modal',
            () => {
                startScanner();
            }
        );

        modal.addEventListener(
            'hidden.bs.modal',
            () => {
                stopScanner();
            }
        );
    }

    /*
     * Saat halaman selesai dimuat
     */
    document.addEventListener(
        'DOMContentLoaded',
        () => {

            watchModal();

            console.log(
                '[QR] qrcode.js loaded'
            );

            console.log(
                '[QR] Mode: qr-scanner + AES-256-CBC'
            );
        }
    );

    /*
     * Bersihkan kamera saat halaman ditutup
     */
    window.addEventListener(
        'beforeunload',
        () => {
            stopScanner();
        }
    );

})();
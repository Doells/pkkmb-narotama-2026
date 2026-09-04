@extends('layouts.dashboard.app')

@section('content')
<div class="">
    <h1 class="my-10 font-bold text-[20px] mx-10 text-center">
        Kirim Presensi - Sesi {{ $dataSesiPresensi->title ?? '' }}
    </h1>

    <div class="">
        <div class="">
            <div class="px-20 mx-auto items-center justify-center">
                <div id="qrcode" class="w-[512px] max-w-full mx-auto flex items-center justify-center"></div>
            </div>

            <p class="text-center text-white mt-4 w-full">
                <span id="reset-timer" class="px-4 py-2 bg-blue-600 rounded-md"></span>
            </p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.4/build/qrcode.min.js"></script>

<script>
(async function () {
    'use strict';

    // SAMA dengan pkkmb.indrianto.cloud/utils/qr-crypto.ts
    const KEY_B64 = 'c+R8LGJChPU+1zoZ1BgJmqaivpKn/Ly/RsapBKI55fY=';
    const IV_B64 = 'UHvpaORuxDGSu+LQuPZmSg==';

    const userId = @json((string) auth()->id());

    function b64ToBytes(b64) {
        const binary = atob(b64);
        const bytes = new Uint8Array(binary.length);

        for (let i = 0; i < binary.length; i++) {
            bytes[i] = binary.charCodeAt(i);
        }

        return bytes;
    }

    function bytesToB64(bytes) {
        const array = new Uint8Array(bytes);
        let binary = '';

        for (let i = 0; i < array.length; i++) {
            binary += String.fromCharCode(array[i]);
        }

        return btoa(binary);
    }

    async function getKey() {
        return crypto.subtle.importKey(
            'raw',
            b64ToBytes(KEY_B64),
            'AES-CBC',
            false,
            ['encrypt']
        );
    }

    async function buildQrPayload() {
        const payload = {
            id: String(userId),
            expired_date: new Date(Date.now() + 5 * 60 * 1000).toISOString()
        };

        const key = await getKey();

        const encrypted = await crypto.subtle.encrypt(
            {
                name: 'AES-CBC',
                iv: b64ToBytes(IV_B64)
            },
            key,
            new TextEncoder().encode(JSON.stringify(payload))
        );

        return bytesToB64(encrypted);
    }

    async function generateQr() {
        const qrContainer = document.getElementById('qrcode');

        try {
            const encryptedPayload = await buildQrPayload();

            await QRCode.toCanvas(
                encryptedPayload,
                {
                    width: 512,
                    margin: 1
                }
            ).then(function (canvas) {
                qrContainer.innerHTML = '';
                qrContainer.appendChild(canvas);
            });

            console.log('[QR] Payload dibuat dengan format pkkmb.indrianto.cloud');
        } catch (error) {
            console.error('[QR] Gagal membuat QR:', error);
            qrContainer.innerHTML =
                '<p class="text-red-400 text-center">QR Code gagal dibuat.</p>';
        }
    }

    function updateResetTimer() {
        const interval = 5 * 60;
        let remainingTime = interval;

        function updateTimer() {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;

            document.getElementById('reset-timer').textContent =
                `QR Code akan reset dalam ${minutes} Menit ${String(seconds).padStart(2, '0')} Detik`;

            if (remainingTime <= 0) {
                location.reload();
                return;
            }

            remainingTime--;
        }

        updateTimer();
        setInterval(updateTimer, 1000);
    }

    if (typeof QRCode === 'undefined') {
        console.error('[QR] Library qrcode tidak ditemukan.');
        document.getElementById('qrcode').innerHTML =
            '<p class="text-red-400 text-center">Library QR Code belum termuat.</p>';
        return;
    }

    await generateQr();
    updateResetTimer();
})();
</script>

@endsection
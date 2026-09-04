@extends('layouts.dashboard.app')

@section('content')
<div class="">
    <h1 class="my-10 font-bold text-[20px] mx-10 text-center">
        Kirim Presensi - Sesi {{$dataSesiPresensi->title ?? ''}}
    </h1>

    <div class="">
        <div class="">
            <div class="px-20 mx-auto items-center justify-center">
                <img
                    alt="QR Code Presensi"
                    src="{{$qrcode}}"
                    class="w-50 h-50 items-center mx-auto"
                >
            </div>

            <p class="text-center text-white mt-4 w-full">
                <span
                    id="reset-timer"
                    class="px-4 py-2 bg-blue-600 rounded-md"
                ></span>
            </p>
        </div>
    </div>
</div>

<script>
function updateResetTimer() {
    const interval = 5 * 60;
    let remainingTime = interval;

    function updateTimer() {
        const minutes = Math.floor(remainingTime / 60);
        const seconds = remainingTime % 60;

        const timer = document.getElementById('reset-timer');

        if (timer) {
            timer.textContent =
                `QR Code akan reset dalam ${minutes} Menit ${String(seconds).padStart(2, '0')} Detik`;
        }

        if (remainingTime <= 0) {
            location.reload();
            return;
        }

        remainingTime--;
    }

    updateTimer();
    setInterval(updateTimer, 1000);
}

updateResetTimer();
</script>

@endsection

<div>
    {{-- Tombol QR Code --}}
    @if ($attendance->data->is_using_qrcode)

    {{-- jika belum absen dan absen masuk sudah dimulai --}}
    <button
        type="button"
        data-is-enter="1"
        data-presensi-code="{{ $attendance->code }}"
        data-modal-target="scannerModal"
        data-modal-toggle="scannerModal"
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full">
        Scan QR-Code Masuk
    </button>

    <form
        id="kirim-presensi"
        action="{{ route('sendEnterPresenceUsingQRCode') }}"
        method="POST"
        hidden>
        @csrf
        <input type="hidden" name="qr_code" id="code-field">
        <button type="submit">Submit</button>
    </form>
  

    {{-- jika sudah absen masuk--}}

    {{-- jika absen pulang sudah dimulai, dan presertan sudah absen masuk dan belum absen keluar atau sesi belum berakhir--}}
    {{-- @if ($attendance->data->is_end && $data['is_has_enter_today'] && $data['is_not_out_yet'] || !$attendance->data->is_end)
    <button data-bs-toggle="modal" data-bs-target="#qrcode-scanner-modal" data-is-enter="1" data-modal-target="scannerModal" data-modal-toggle="scannerModal" data-is-enter="0" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 w-full" data-bs-toggle="modal"
        data-bs-target="#qrcode-scanner-modal">Scan QRCode Keluar</button>
    @endif --}}

    {{-- sudah absen masuk dan absen keluar --}}
    {{-- @if ($data['is_has_enter_today'] && !$data['is_not_out_yet'])
    <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Anda sudah melakukan absen masuk dan absen keluar.</span>
        </div>
    </div>
    @endif --}}

    {{-- jika sudah absen masuk dan belum saatnya absen pulang --}}
    {{-- @if ($data['is_has_enter_today'] && !$attendance->data->is_start)
    <div class="flex items-center p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
          <span class="font-medium">Belum saatnya melakukan presensi keluar.</span>
        </div>
    </div>
    @endif --}}

    @endif
</div>

@push('script')
<script
    src="https://cdn.jsdelivr.net/npm/qr-scanner@1.4.2/qr-scanner.umd.min.js"
    integrity="sha512-Fb3L5w+k6OMng6v8gWYr7fuO//kwaC0PfMReI2pYIRYHRfkjvrsNHoGkiVCvjNkrXX3+Ve9Ag+COx98AZlvR7w=="
    crossorigin="anonymous">
</script>
<script src="{{ asset('js/home/qrcode.js') }}"></script>
@endpush
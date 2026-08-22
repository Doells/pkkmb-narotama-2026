    @auth
        <div class="px-5 lg:px-12 py-10 w-full rounded-[24px] bg-white shadow-sm border border-cine-navy/10 mt-5">
            <h2 class="text-2xl font-black text-cine-navy mb-6">Tugas PKKMB</h2>
            <iframe class="mb-6 rounded-lg border border-zinc-200" src="{{ asset('/src/document/tugas_pkkmb2023.pdf') }}" width="100%" height="800px"></iframe>

            <div class="text-center md:text-left">
                <a href="{{ asset('/src/document/tugas_pkkmb2023.pdf') }}" download="tugas_pkkmb2023.pdf" class="bg-cine-yellow hover:bg-cine-navy hover:text-cine-cream px-8 py-3 text-cine-navy font-bold text-base rounded-[12px] transition-colors inline-block cinematic-shadow">
                    Unduh Data Tugas
                </a>
            </div>
        </div>
    @endauth
    @guest
        <div class="w-full h-auto py-[64px] px-[24px] flex flex-col items-center justify-center bg-white rounded-[24px] shadow-sm border border-cine-navy/10 mt-5 text-center">
            <div class="w-20 h-20 bg-cine-yellow/20 rounded-full flex items-center justify-center mb-6 text-cine-navy">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </div>
            <h2 class="font-black text-2xl lg:text-3xl mb-2 text-cine-navy">Akses Terbatas</h2>
            <p class="font-medium text-base text-cine-navy/70 mb-8 max-w-[400px]">Silahkan masuk menggunakan akun peserta untuk mengakses dokumen penugasan.</p>
            <a href="{{ route('home-presences.indexuserdashboard') }}" class="font-bold text-base text-cine-navy bg-cine-yellow py-3 px-8 rounded-[12px] hover:shadow-md hover:bg-cine-navy hover:text-cine-cream transition-colors">
                Masuk Akses
            </a>
        </div>
    @endguest
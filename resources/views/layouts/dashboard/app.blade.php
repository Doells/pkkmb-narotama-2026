@extends('layouts.dashboard.base')

@section('base')

@include('partials.navbar')

<div class="cine-admin-content">
    <div class="row">
        <main class="w-full">
            <div
                class="items-center pt-3 pb-2 mb-3 border-b-4">
                @php
                    $sceneNumber = '01'; // Default
                    if (str_contains(strtolower($title), 'peserta')) $sceneNumber = '02';
                    elseif (str_contains(strtolower($title), 'admin')) $sceneNumber = '03';
                    elseif (str_contains(strtolower($title), 'tugas')) $sceneNumber = '04';
                    elseif (str_contains(strtolower($title), 'kumpul')) $sceneNumber = '05';
                    elseif (str_contains(strtolower($title), 'kelompok')) $sceneNumber = '06';
                    elseif (str_contains(strtolower($title), 'posisi')) $sceneNumber = '07';
                    elseif (str_contains(strtolower($title), 'berita')) $sceneNumber = '08';
                    elseif (str_contains(strtolower($title), 'ketentuan')) $sceneNumber = '09';
                    elseif (str_contains(strtolower($title), 'pelanggaran')) $sceneNumber = '11';
                    elseif (str_contains(strtolower($title), 'hasil')) $sceneNumber = '12';
                @endphp
                <span class="text-xs font-bold uppercase tracking-widest mb-1 block cine-admin-label" style="color: #50D6B2 !important;">SCENE {{ $sceneNumber }} — {{ strtoupper($title) }}</span>
                <h1 class="font-semibold text-lg">{{ $title }}</h1>
                {{-- <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar" class="align-text-bottom"></span>
                        This week
                    </button>
                </div> --}}
                @yield('buttons')
            </div>

            <div class="py-4">
                @include('sweetalert::alert')

                @yield('content')
            </div>
        </main>
    </div>
</div>
@endsection
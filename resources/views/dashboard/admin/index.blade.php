@extends('layouts.dashboard.app')

@section('content')
<div class="cine-stat-grid cine-stat-grid-admin">
    @php
        $statistics = [
            ['label' => 'Total Tugas', 'value' => $taskCount, 'route' => route('tambahtugas.index'), 'accent' => 'yellow'],
            ['label' => 'Total Presensi', 'value' => $presencesCount, 'route' => route('attendances.index'), 'accent' => 'blue'],
            ['label' => 'Total Pelanggaran', 'value' => $pelanggaranCount, 'route' => route('admin.pelanggaran.index'), 'accent' => 'coral'],
            ['label' => 'Total Posisi', 'value' => $positionCount, 'route' => route('positions.index'), 'accent' => 'mint'],
            ['label' => 'Total Kelompok', 'value' => $kelompokCount, 'route' => route('kelompok.index'), 'accent' => 'blue'],
            ['label' => 'Total Peserta', 'value' => $pesertaCount, 'route' => route('students.index'), 'accent' => 'yellow'],
            ['label' => 'Total Panitia', 'value' => $panitiaCount, 'route' => route('admin.index'), 'accent' => 'mint'],
        ];
    @endphp

    @foreach ($statistics as $index => $statistic)
        <a href="{{ $statistic['route'] }}" class="cine-stat-card cine-stat-card-{{ $statistic['accent'] }}">
            <span class="cine-stat-scene">SHOT {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
            <h2>{{ $statistic['label'] }}</h2>
            <strong>{{ $statistic['value'] }}</strong>
            <span class="cine-stat-action">Lihat data <span aria-hidden="true">→</span></span>
        </a>
    @endforeach
</div>
@endsection

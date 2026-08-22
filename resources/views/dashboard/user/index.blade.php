@extends('layouts.dashboard.app')

@section('content')
<div class="cine-stat-grid cine-stat-grid-user">
    <a href="{{ route('dashboard-user.taskindex') }}" class="cine-stat-card cine-stat-card-yellow">
        <span class="cine-stat-scene">MY TASK</span>
        <h2>Total Tugas</h2>
        <strong>{{ $taskCount }}</strong>
        <span class="cine-stat-action">Lihat tugas <span aria-hidden="true">→</span></span>
    </a>

    <a href="{{ route('home-presences.index') }}" class="cine-stat-card cine-stat-card-mint">
        <span class="cine-stat-scene">ATTENDANCE</span>
        <h2>Total Presensi</h2>
        <strong>{{ $presencesCount }}</strong>
        <span class="cine-stat-action">Lihat presensi <span aria-hidden="true">→</span></span>
    </a>
</div>
@endsection

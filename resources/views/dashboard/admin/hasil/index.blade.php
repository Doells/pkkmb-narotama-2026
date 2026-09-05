@extends('layouts.dashboard.app')

@section('content')
    <section class="cine-results-page" aria-labelledby="results-heading">
        <div class="cine-results-overview">
            <div class="cine-results-intro">
                <span class="cine-results-kicker">FINAL CUT — REKAP KELULUSAN</span>
                <h2 id="results-heading">Data Kelulusan Peserta</h2>
                <p>Nilai akhir dihitung dari presensi, tugas yang diterima, dan ketaatan peserta.</p>
            </div>

            <div class="cine-results-metrics" aria-label="Ringkasan data hasil">
                <div class="cine-results-metric"><span>Peserta</span><strong>{{ $peserta->count() }}</strong></div>
                <div class="cine-results-metric"><span>Total tugas</span><strong>{{ $taskCount }}</strong></div>
                <div class="cine-results-metric"><span>Sesi presensi</span><strong>{{ $presencesCount }}</strong></div>
            </div>

            <form action="{{ route('hasil.export-excel') }}" method="POST" target="_blank" class="cine-results-export">
                @csrf
                <button type="submit"><span aria-hidden="true">↓</span> Export Excel</button>
            </form>
        </div>

        @if ($peserta->isNotEmpty())
            <div class="cine-results-card">
                <div class="cine-results-card-heading">
                    <div><span class="cine-results-reel" aria-hidden="true"></span><h3>Daftar hasil peserta</h3></div>
                    <p>Geser tabel ke samping untuk melihat seluruh kolom.</p>
                </div>

                <div class="cine-results-table-wrap" tabindex="0" role="region" aria-label="Tabel hasil kelulusan peserta">
                    <table class="cine-results-table">
                        <thead>
                            <tr>
                                <th scope="col">No</th><th scope="col">NIM</th><th scope="col">Nama peserta</th>
                                <th scope="col">Kelompok</th><th scope="col">Hadir</th><th scope="col">Izin</th>
                                <th scope="col">Tugas</th><th scope="col">Poin</th><th scope="col">Keputusan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $key => $item)
                                @php
                                    $presensiHadir = $item->submitPresensi->where('is_permission', 0)->count();
                                    $presensiIzin = $item->submitPresensi->where('is_permission', 1)->count();
                                    $presensiMasuk = $item->submitPresensi->count();
                                    $tugasDikerjakan = $item->submitTugas->where('status', 'Diterima')->count();
                                    $totalPelanggaran = $item->pelanggaran_peserta->sum('poin');
                                    $totalPresensi = $presencesCount > 0 ? round(($presensiMasuk / $presencesCount) * 100, 2) : 0;
                                    $totalTugas = $taskCount > 0 ? round(($tugasDikerjakan / $taskCount) * 100, 2) : 0;
                                    $ketaatan = max(0, 100 - $totalPelanggaran);
                                    $totalSkor = round(($totalPresensi + $totalTugas + $ketaatan) / 3, 2);

                                    if ($totalSkor <= 59) {
                                        $keputusan = 'Tidak Lulus';
                                        $decisionClass = 'is-failed';
                                    } elseif ($totalSkor >= 80) {
                                        $keputusan = 'Lulus';
                                        $decisionClass = 'is-passed';
                                    } else {
                                        $keputusan = 'Lulus Bersyarat';
                                        $decisionClass = 'is-conditional';
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td><strong class="cine-results-nim">{{ $item->nim ?? '—' }}</strong></td>
                                    <td class="cine-results-name">{{ ucfirst($item->name ?? '—') }}</td>
                                    <td>{{ optional($item->kelompok)->name ?? 'Belum ditentukan' }}</td>
                                    <td>{{ $presensiHadir }}</td><td>{{ $presensiIzin }}</td>
                                    <td>{{ $tugasDikerjakan }}</td><td>{{ $totalPelanggaran }}</td>
                                    <td>
                                        <span class="cine-results-decision {{ $decisionClass }}">{{ $keputusan }}</span>
                                        <span class="cine-results-score">Skor {{ $totalSkor }}</span>
                                        <span class="cine-results-breakdown">P {{ $totalPresensi }}% · T {{ $totalTugas }}% · K {{ $ketaatan }}%</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="cine-results-empty">
                <span aria-hidden="true">00</span><h3>Belum ada peserta</h3>
                <p>Tambahkan akun peserta terlebih dahulu untuk menampilkan hasil kelulusan.</p>
                <a href="{{ route('students.create') }}">+ Tambah Peserta</a>
            </div>
        @endif
    </section>
@endsection

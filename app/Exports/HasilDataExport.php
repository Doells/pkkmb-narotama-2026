<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\TambahTugas;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HasilDataExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $peserta = User::where('position_id', '1')
            ->with(['kelompok', 'submitPresensi', 'submitTugas', 'pelanggaran_peserta'])
            ->get();
            
        $positionPeserta = '1';
        
        $presencesCount = Attendance::query()
            ->whereHas('positions', function ($query) use ($positionPeserta) {
                $query->where('position_id', $positionPeserta);
            })
            ->count();
            
        $taskCount = TambahTugas::count();
        
        // Lakukan perhitungan atau manipulasi data sesuai kebutuhan Anda
        $data = [];
        foreach ($peserta as $key => $item) {
            //poin pelanggaran
            $totalPoinPelanggaran = 0; // Inisialisasi total poin pelanggaran
            foreach ($item->pelanggaran_peserta as $pelanggaran) {
                $totalPoinPelanggaran += $pelanggaran->poin;
            }
            
            //hasil akhir/keputusan
            $presensiMasuk = optional($item->submitPresensi)->count() ?? 0;
            //$totalIzin = optional($item->submitPresensi)->where('is_permission', 1)->count() ?? 0;
            $tugasDikerjakan = optional($item->submitTugas->where('status', 'Diterima'))->count() ?? 0;
            $totalPelanggaran = $item->pelanggaran_peserta->sum('poin');
            
            //total
            $totalPresensi = $presencesCount > 0
                ? round(($presensiMasuk / $presencesCount) * 100, 2)
                : 0;
            $totalTugas = $taskCount > 0
                ? round(($tugasDikerjakan / $taskCount) * 100, 2)
                : 0;
            $ketaatan = max(0, 100 - $totalPelanggaran);
            
            $totalSkor = ($totalPresensi + $totalTugas + $ketaatan) / 3;
            
            $keputusan = '';
            if ($totalSkor <= 40) {
                $keputusan = 'Tidak Lulus';
            } elseif ($totalSkor >= 80) {
                $keputusan = 'Lulus';
            } else {
                $keputusan = 'Lulus Bersyarat';
            }
            
            //input data
            $data[] = [
                $key + 1,
                $item->nim ?? '',
                ucfirst($item->name ?? ''),
                optional($item->kelompok)->name ?? 'Belum ditentukan',
                optional($item->submitPresensi->where('is_permission', 0))->count() ?? 0,
                optional($item->submitPresensi->where('is_permission', 1))->count() ?? 0,
                optional($item->submitTugas->where('status', 'Diterima'))->count() ?? 0,
                $totalPoinPelanggaran,
                $keputusan,
                // ... sambungkan dengan perhitungan atau data lain yang sesuai
            ];
        }
        
        return collect($data);
    }
    
    public function headings(): array
    {
        // Tentukan judul kolom pada file Excel
        return [
            'No',
            'NIM',
            'Nama Peserta',
            'Kelompok',
            'Presensi',
            'Izin',
            'Tugas',
            'Pelanggaran',
            'Keputusan',
            // Tambahkan kolom lain sesuai kebutuhan
        ];
    }
}
<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelompokController extends Controller
{
    public function index()
    {
        return view('dashboard.admin.kelompok.index', [
            "title" => "Data Kelompok"
        ]);
    }

    public function create()
    {
        return view('dashboard.admin.kelompok.create', [
            "title" => "Tambah Data Kelompok",
            "kelompok" => "kelompok"
        ]);
    }

    public function edit()
    {
        return view('dashboard.admin.kelompok.edit', [
            "title" => "Edit Data Kelompok",
            "kelompok" => Kelompok::findOrFail(request('id'))
        ]);
    }

    public function destroy(Kelompok $kelompok)
    {
        try {
            DB::transaction(function () use ($kelompok): void {
                User::where('kelompok_id', $kelompok->id)->update(['kelompok_id' => null]);
                $kelompok->delete();
            });

            return back()->with('success', 'Data kelompok berhasil dihapus.');
        } catch (\Throwable $ex) {
            report($ex);
            return back()->with('error', 'Gagal menghapus data kelompok.');
        }
    }
}

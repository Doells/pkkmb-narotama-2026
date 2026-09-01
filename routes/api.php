<?php

use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FileController;
use App\Http\Controllers\Api\HomePresenceController;
use App\Http\Controllers\Api\JenisKetentuanController;
use App\Http\Controllers\Api\KelompokController;
use App\Http\Controllers\Api\KetentuanController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\PelanggaranController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\PresenceController;
use App\Http\Controllers\Api\ResultTaskController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TambahTugasController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\DataKelulusanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/logout', [AuthController::class, 'logout'])->name('api.auth.logout');

    /* Detail Peserta */
    Route::get('/dashboard/detail-user', [StudentController::class, 'detailUser'])->name('api.detail-user');

    /* Admin dan Superadmin */
    Route::middleware(['role:admin,superadmin'])->group(function() {
        // Tambah Tugas
        Route::get('/dashboard/admin/tugas', [TambahTugasController::class, 'index'])->name('api.tambahtugas.index');
        Route::post('/dashboard/admin/tugas/tambah-data', [TambahTugasController::class, 'create'])->name('api.tambahtugas.create');
        Route::post('/dashboard/admin/tugas/edit', [TambahTugasController::class, 'edit'])->name('api.tambahtugas.edit');
        Route::delete('/dashboard/admin/tugas/delete/{tambahtugas}', [TambahTugasController::class, 'destroy'])->name('api.tambahtugas.destroy');

        // Data Pengumpulan Tugas
        Route::get('/dashboard/admin/tugas/pengumpulan', [ResultTaskController::class, 'index'])->name('api.result-task.index');
        Route::get('/dashboard/admin/tugas/pengumpulan/detail-tugas/{tambahtugas}', [ResultTaskController::class, 'show'])->name('api.result-task.show');
        Route::get('/dashboard/admin/tugas/pengumpulan/hasil/{id_task}', [ResultTaskController::class, 'showResultTaskUser'])->name('api.result-task.showResultTaskUser');
        Route::get('/dashboard/admin/tugas/pengumpulan/tidak-mengumpulkan/{id_tambahtugas}', [ResultTaskController::class, 'notSubmit'])->name('api.result-task.notSubmit');
        Route::post('/dashboard/admin/tugas/pengumpulan/status', [ResultTaskController::class, 'updateStatus'])->name('api.result-task.updateStatus');
        Route::delete('/dashboard/admin/tugas/pengumpulan/delete/{id_task}', [ResultTaskController::class, 'destroy'])->name('api.result-task.destroy');

        //Berita
        Route::get('/dashboard/admin/news', [NewsController::class, 'index'])->name('api.news.index');
        Route::post('/dashboard/admin/news/store', [NewsController::class, 'store'])->name('api.news.store');
        Route::get('/dashboard/admin/news/edit', [NewsController::class, 'edit'])->name('api.news.edit');
        Route::post('/dashboard/admin/news/update', [NewsController::class, 'update'])->name('api.news.update');
        Route::delete('/dashboard/admin/news/delete/{id_berita}', [NewsController::class, 'destroy'])->name('api.news.destroy');

        //Jenis Ketentuan
        Route::get('/dashboard/admin/jenis-ketentuan', [JenisKetentuanController::class, 'index'])->name('api.jenisketentuan.index');
        Route::post('/dashboard/admin/jenis-ketentuan/store', [JenisKetentuanController::class, 'store'])->name('api.jenisketentuan.store');
        Route::post('/dashboard/admin/jenis-ketentuan/update', [JenisKetentuanController::class, 'update'])->name('api.jenisketentuan.update');
        Route::delete('/dashboard/admin/jenis-ketentuan/delete/{id_jenis_ketentuan}', [JenisKetentuanController::class, 'destroy'])->name('api.jenisketentuan.destroy');

        //Ketentuan
        Route::get('/dashboard/admin/ketentuan', [KetentuanController::class, 'index'])->name('api.ketentuan.index');
        Route::post('/dashboard/admin/ketentuan/store', [KetentuanController::class, 'store'])->name('api.ketentuan.store');
        Route::post('/dashboard/admin/ketentuan/update', [KetentuanController::class, 'update'])->name('api.ketentuan.update');
        Route::delete('/dashboard/admin/ketentuan/delete/{id_ketentuan}', [KetentuanController::class, 'destroy'])->name('api.ketentuan.destroy');

        //Pelanggaran
        Route::get('/dashboard/admin/pelanggaran', [PelanggaranController::class, 'index'])->name('api.pelanggaran.index');
        Route::post('/dashboard/admin/pelanggaran/store', [PelanggaranController::class, 'store'])->name('api.pelanggaran.store');
        Route::post('/dashboard/admin/pelanggaran/update', [PelanggaranController::class, 'update'])->name('api.pelanggaran.update');
        Route::delete('/dashboard/admin/pelanggaran/delete/{id_pelanggaran}', [PelanggaranController::class, 'destroy'])->name('api.pelanggaran.destroy');

        //Presensi
        Route::get('/dashboard/admin/presensi', [PresenceController::class, 'index'])->name('api.presences.index');
        Route::get('/dashboard/admin/presensi/qrcode', [PresenceController::class, 'showQrcode'])->name('api.presences.qrcode');
        Route::get('/dashboard/admin/presensi/{id}', [PresenceController::class, 'show'])->name('api.presences.show');
        Route::delete('/dashboard/admin/presensi/{presence}', [PresenceController::class, 'destroy'])->name('api.presence.destroy');
    });

    /* Khusus Superadmin */
    Route::middleware(['role:superadmin'])->group(function() {
        //Data Akun Peserta
        Route::get('/dashboard/admin/peserta', [StudentController::class, 'index'])->name('api.students.index');
        Route::post('/dashboard/admin/peserta/tambah-data', [StudentController::class, 'create'])->name('api.students.create');
        Route::post('/dashboard/admin/peserta/edit', [StudentController::class, 'update'])->name('api.students.update');
        Route::delete('/dashboard/admin/peserta/{users}', [StudentController::class, 'destroy'])->name('api.students.destroy');

        //Data Akun Admin
        Route::get('/dashboard/admin/akun-admin', [StudentController::class, 'indexAdmin'])->name('api.admin.index');
        Route::post('/dashboard/admin/akun-admin/tambah-data', [StudentController::class, 'create'])->name('api.admin.create');
        Route::post('/dashboard/admin/akun-admin/edit', [StudentController::class, 'update'])->name('api.admin.update');
        Route::delete('/dashboard/admin/akun-admin/{users}', [StudentController::class, 'destroy'])->name('api.admin.destroy');

        //Data kelompok
        Route::get('/dashboard/admin/kelompok', [KelompokController::class, 'index'])->name('api.kelompok.index');
        Route::post('/dashboard/admin/kelompok/tambah-data', [KelompokController::class, 'create'])->name('api.kelompok.create');
        Route::post('/dashboard/admin/kelompok/edit', [KelompokController::class, 'edit'])->name('api.kelompok.edit');
        Route::delete('/dashboard/admin/kelompok/{id_kelompok}', [KelompokController::class, 'destroy'])->name('api.kelompok.destroy');

        // positions
        Route::get('/dashboard/admin/posisi', [PositionController::class, 'index'])->name('api.positions.index');
        Route::post('/dashboard/admin/posisi/tambah-data', [PositionController::class, 'create'])->name('api.positions.create');
        Route::post('/dashboard/admin/posisi/edit', [PositionController::class, 'edit'])->name('api.positions.edit');
        Route::delete('/dashboard/admin/posisi/{position}', [PositionController::class, 'destroy'])->name('api.positions.destroy');

        //Data Kehadiran
        Route::get('/dashboard/admin/kehadiran', [AttendanceController::class, 'index'])->name('api.attendances.index');

        //Data Kelulusan
        Route::get('/dashboard/admin/data-kelulusan/index', [DataKelulusanController::class, 'index'])->name('api.data-kelulusan.index');
        Route::post('/dashboard/admin/data-kelulusan/store', [DataKelulusanController::class, 'store'])->name('api.data-kelulusan.store');
        Route::post('/dashboard/admin/data-kelulusan/update', [DataKelulusanController::class, 'update'])->name('api.data-kelulusan.update');
    });

    /* User (All Roles) */
    Route::get('/dashboard/user/presensi', [HomePresenceController::class, 'index'])->name('api.home.index');
    Route::post('/dashboard/admin/presensi/qrcode/kirim-presensi', [HomePresenceController::class, 'sendEnterPresenceUsingQRCode'])->name('api.sendEnterPresenceUsingQRCode');
    Route::get('/dashboard/user/presensi/{attendance}', [HomePresenceController::class, 'show'])->name('api.home.show');

    //tugas
    Route::get('/dashboard/user/tugas', [TaskController::class, 'taskindex'])->name('api.taskindex');
    Route::get('/dashboard/user/tugas/edit-text/{id}', [TaskController::class, 'taskedit'])->name('api.taskedit');
    Route::get('/dashboard/user/tugas/edit-file/{id}', [TaskController::class, 'fileedit'])->name('api.fileedit');
    Route::get('/dashboard/user/tugas/{tambahtugas}', [TaskController::class, 'taskshow'])->name('api.taskshow');
    Route::get('/dashboard/user/tugas/download/{folder}/{filename}', [FileController::class, 'download'])->name('api.download');
    Route::post('/dashboard/user/tugas/file/{tambahtugas}', [TaskController::class, 'uploadFile'])->name('api.uploadFile');
    Route::post('/dashboard/user/tugas/{tambahtugas}/unggah', [TaskController::class, 'sendTask'])->name('api.sendTask');
    Route::post('/dashboard/user/tugas/edit-text/{tambahtugas}', [TaskController::class, 'updateTask'])->name('api.updateTask');
    Route::post('/dashboard/user/tugas/edit-file/{tambahtugas}', [TaskController::class, 'updateFile'])->name('api.updateFile');
});


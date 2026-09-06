<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Permission;
use App\Models\Presence;
use App\Models\UniqueCode;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PresenceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::all()->sortByDesc('data.is_end')->sortByDesc('data.is_start');

        return view('dashboard.admin.presences.index', [
            "title" => "Daftar Presensi Dengan Kehadiran",
            "attendances" => $attendances
        ]);
    }

    public function show(Attendance $attendance)
    {
        $attendance->load(['positions', 'presences']);

        // dd($qrcode);
        return view('dashboard.admin.presences.show', [
            "title" => "Data Detail Kehadiran",
            "attendance" => $attendance,
        ]);
    }

    public function destroy(Presence $presence)
    {
        try {
            $presence->delete();
            Alert::success('Berhasil!', 'Presensi peserta berhasil dihapus.');
            return redirect()->back();
        } catch (\Exception $ex) {
            Alert::error('Gagal!', 'Presensi peserta gagal dihapus.');
            return redirect()->back();
        }
    }

    /**
     * Generate QR peserta/panitia.
     * Format: AES-256-CBC(Base64(JSON {id, expired_date}))
     * Compatible with pkkmb.indrianto.cloud.
     */
    public function showQrcode()
    {
        $code = request('code');
        $userId = (string) auth()->user()->id;

        $payload = json_encode([
            'id' => $userId,
            'expired_date' => Carbon::now()->addMinutes(5)->toISOString(),
        ], JSON_UNESCAPED_SLASHES);

        $key = base64_decode('c+R8LGJChPU+1zoZ1BgJmqaivpKn/Ly/RsapBKI55fY=');
        $iv = base64_decode('UHvpaORuxDGSu+LQuPZmSg==');

        $encrypted = openssl_encrypt(
            $payload,
            'AES-256-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );

        if ($encrypted === false) {
            abort(500, 'Gagal membuat QR Code.');
        }

        $encryptQrCodeContent = base64_encode($encrypted);

        $dataSesiPresensi = $code
            ? Attendance::where('code', $code)->first()
            : null;

        $qrcode = 'data:image/svg+xml;base64,' . base64_encode(
            QrCode::size(512)->margin(1)->generate($encryptQrCodeContent)
        );

        return view('dashboard.admin.presences.qrcode', [
            'title' => 'Presensi QRCode',
            'qrcode' => $qrcode,
            'code' => $code,
            'dataSesiPresensi' => $dataSesiPresensi,
        ]);
    }

    /* public function generateQrCode(Request $request)
    {
        $code = $request->input('code'); // Ambil kode dari permintaan
        
        // Validasi bahwa $code ada di database
        if (!$code || !Attendance::query()->where('code', $code)->exists()) {
            return response()->json(['error' => 'Data Sesi Presensi tidak ditemukan!'], 404);
        }
    
        $randomString = Str::random(10); // Menghasilkan string acak sepanjang 10 karakter
        $qrCodeContent = "kode-{$randomString}-{$code}";
    
        // Generate QR code dan ubah ke base64
        $qrCodeImage =  "data:image/svg+xml;base64," . base64_encode(QrCode::size(300)->style('round')->generate($qrCodeContent));
        $base64QrCode = base64_encode($qrCodeImage);
    
        return response()->json(['qr_code' => $qrCodeImage]);
    } */

    /**
     * Validasi QR format baru dan kompatibilitas dengan URL lama.
     */
    public function checkDataQrCode(Request $request)
    {
        $code = $request->input('code');

        if (!$code) {
            Alert::error('Gagal!', 'QR Code tidak valid!');
            return redirect()->back();
        }

        try {
            $payload = $this->decryptCompatibleQr($code);

            if (!isset($payload['id'], $payload['expired_date'])) {
                throw new \RuntimeException('Payload QR tidak lengkap.');
            }

            if (Carbon::parse($payload['expired_date'])->isPast()) {
                Alert::error('Gagal!', 'QR Code sudah tidak berlaku!');
                return redirect()->back();
            }

            $dataUser = User::where('id', $payload['id'])
                ->with('detailuser', 'kelompok', 'position')
                ->firstOrFail();

            $attendanceCode = $request->input('presensi_code');
            $dataSesiPresensi = $attendanceCode
                ? Attendance::where('code', $attendanceCode)->first()
                : null;

            $isEnteredToday = $dataSesiPresensi
                ? Presence::query()
                    ->where('user_id', $payload['id'])
                    ->where('attendance_id', $dataSesiPresensi->id)
                    ->whereDate('presence_date', $dataSesiPresensi->date)
                    ->exists()
                : false;

            return view('dashboard.admin.presences.check-data', [
                'title' => 'Presensi QRCode',
                'dataUser' => $dataUser,
                'dataSesiPresensi' => $dataSesiPresensi,
                'code' => $code,
                'statusPresensi' => $isEnteredToday,
            ]);
        } catch (\Throwable $e) {
            Alert::error('Gagal!', 'QR Code tidak valid atau sudah kadaluarsa!');
            return redirect()->back();
        }
    }

    /**
     * Menerima format yang sama dengan project sumber:
     * userId-presensiCode
     */
    public function sendEnterPresenceUsingQRCode(Request $request)
    {
        $qrCode = $request->input('qr_code');

        // Kompatibilitas flow lama.
        if (!$qrCode && $request->filled('code')) {
            try {
                $payload = $this->decryptCompatibleQr($request->input('code'));
                $attendanceCode = $request->input('presensi_code');

                if (!$attendanceCode && isset($payload['presensi_code'])) {
                    $attendanceCode = $payload['presensi_code'];
                }

                $qrCode = isset($payload['id'], $attendanceCode)
                    ? $payload['id'] . '-' . $attendanceCode
                    : null;
            } catch (\Throwable $e) {
                $qrCode = null;
            }
        }

        if (!$qrCode || !str_contains($qrCode, '-')) {
            Alert::error('Gagal!', 'QR Code tidak valid, coba lagi!');
            return redirect()->back();
        }

        [$userId, $attendanceCode] = explode('-', $qrCode, 2);

        if (!ctype_digit((string) $userId) || !$attendanceCode) {
            Alert::error('Gagal!', 'QR Code tidak valid, coba lagi!');
            return redirect()->back();
        }

        $attendance = Attendance::where('code', $attendanceCode)->first();

        if (!$attendance) {
            Alert::error('Gagal!', 'Sesi presensi tidak ditemukan!');
            return redirect()->back();
        }

        $dataUser = User::find($userId);

        if (!$dataUser) {
            Alert::error('Gagal!', 'Peserta tidak ditemukan!');
            return redirect()->back();
        }

        $isEnteredToday = Presence::query()
            ->where('user_id', $userId)
            ->where('attendance_id', $attendance->id)
            ->whereDate('presence_date', $attendance->date)
            ->exists();

        if ($isEnteredToday) {
            Alert::error('Gagal!', 'Peserta sudah melakukan presensi masuk pada sesi ini.');
            return redirect()->route('presences.show', $attendance->id);
        }

        Presence::create([
            'user_id' => $userId,
            'attendance_id' => $attendance->id,
            'presence_date' => now()->toDateString(),
            'presence_enter_time' => now()->toTimeString(),
            'is_permission' => false,
        ]);

        Alert::success(
            'Berhasil!',
            "Kehadiran atas nama '" . $dataUser->name . "' berhasil dikirim."
        );

        return redirect()->route('presences.show', $attendance->id);
    }

    /**
     * AES-256-CBC kompatibel dengan qr-crypto.ts pada project sumber.
     */
    private function decryptCompatibleQr(string $encryptedText): array
    {
        $key = base64_decode('c+R8LGJChPU+1zoZ1BgJmqaivpKn/Ly/RsapBKI55fY=');
        $iv = base64_decode('UHvpaORuxDGSu+LQuPZmSg==');

        $encrypted = base64_decode($encryptedText, true);

        if ($encrypted === false) {
            throw new \RuntimeException('Base64 QR tidak valid.');
        }

        $decrypted = openssl_decrypt(
            $encrypted,
            'AES-256-CBC',
            $key,
            OPENSSL_RAW_DATA,
            $iv
        );

        if ($decrypted === false) {
            throw new \RuntimeException('QR tidak dapat didekripsi.');
        }

        $payload = json_decode($decrypted, true);

        if (!is_array($payload)) {
            throw new \RuntimeException('Payload QR tidak valid.');
        }

        return $payload;
    }

    public function notPresent(Attendance $attendance)
    {
        $presences = Presence::query()
            ->where('attendance_id', $attendance->id)
            ->get(['user_id']);
            
        $positionIds = $attendance->positions->pluck('id')->toArray();
        $attendedUserIds = $presences->pluck('user_id')->toArray();

        $absentUsers = User::query()
            ->with('position')
            ->whereIn('position_id', $positionIds)
            ->whereNotIn('id', $attendedUserIds)
            ->get()
            ->toArray();

        $notPresentData = [
            [
                "not_presence_date" => $attendance->date,
                "users" => $absentUsers
            ]
        ];

        return view('dashboard.admin.presences.not-present', [
            "title" => "Data Peserta Tidak Hadir",
            "attendance" => $attendance,
            "notPresentData" => $notPresentData
        ]);
    }

    public function acceptPermissionByAdmin(Request $request, $attendanceId)
    {
        //dd($request->all()); // Debugging
    
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'presence_date' => 'required|date',
            'permission_reason' => 'required|string',
        ]);
    
        //dd('Validation passed'); // Debugging
    
        // Dapatkan objek Attendance sesuai dengan $attendanceId
        $attendance = Attendance::findOrFail($attendanceId);
    
        //dd('Attendance found'); // Debugging
        
        // Dapatkan objek User sesuai dengan user_id dari input
        $user = User::findOrFail($request->user_id);
    
        //dd('User found'); // Debugging
    
        // Simpan izin dan alasan izin oleh admin ke database
        $attendance->presences()->create([
            'user_id' => $user->id,
            'presence_date' => $request->presence_date,
            "presence_enter_time" => now()->toTimeString(),
            'is_permission' => true,
            'permission_reason' => $request->permission_reason,
        ]);
    
        //dd('Permission saved'); // Debugging
    
        return redirect()->back()->with('success', "Berhasil menyimpan data izin atas nama \"$user->name\".");
    }
    
    

    public function presentUser(Request $request, $attendanceId)
    {
        //dd($request->all()); // Debugging
    
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'presence_date' => 'required|date',
        ]);
    
        //dd('Validation passed'); // Debugging
    
        // Dapatkan objek Attendance sesuai dengan $attendanceId
        $attendance = Attendance::findOrFail($attendanceId);
    
        //dd('Attendance found'); // Debugging
        
        // Dapatkan objek User sesuai dengan user_id dari input
        $user = User::findOrFail($request->user_id);
    
        //dd('User found'); // Debugging
    
        // Simpan Kehadiran
        $attendance->presences()->create([
            'user_id' => $user->id,
            'presence_date' => $request->presence_date,
            "presence_enter_time" => now()->toTimeString(),
            'is_permission' => false,
            'permission_reason' => $request->permission_reason,
        ]);
    
        //dd('Permission saved'); // Debugging

        return back()
            ->with('success', "Berhasil menyimpan data hadir atas nama \"$user->name\".");
    }
}
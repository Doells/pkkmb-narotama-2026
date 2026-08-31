<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use \Illuminate\Support\Str;

class AttendanceCreateForm extends AttendanceAbstract
{
    public function save()
    {
        // filter value before validate
        $filtered_ids = [];
        foreach ($this->position_ids as $key => $value) {
            if (is_bool($value) && $value === true) {
                $filtered_ids[] = (int) $key;
            } elseif (is_numeric($value)) {
                $filtered_ids[] = (int) $value;
            }
        }
        $this->position_ids = $filtered_ids;
        $position_ids = $filtered_ids;

        $this->validate();

        if ($this->attendance['code']) // jika menggunakan qrcode
            $this->attendance['code'] = Str::random();

        $attendance = Attendance::create($this->attendance);
        $attendance->positions()->attach($position_ids);

        redirect()->route('attendances.index')->with('success', "Data absensi berhasil ditambahkan.");
    }

    public function render()
    {
        return view('livewire.attendance-create-form');
    }
}

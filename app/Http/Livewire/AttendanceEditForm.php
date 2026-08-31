<?php

namespace App\Http\Livewire;

use App\Models\Attendance;
use Illuminate\Support\Str;

class AttendanceEditForm extends AttendanceAbstract
{
    public $initialCode;

    public function mount()
    {
        parent::mount();
        // format time
        $this->attendance['start_time'] = substr($this->attendance['start_time'], 0, -3);
        $this->attendance['batas_start_time'] = substr($this->attendance['batas_start_time'], 0, -3);
        /* $this->attendance['end_time'] = substr($this->attendance['end_time'], 0, -3);
        $this->attendance['batas_end_time'] = substr($this->attendance['batas_end_time'], 0, -3); */

        $this->initialCode = $this->attendance['code']; // ini untuk pengecekan/mengatasi update code
        $this->attendance['code'] = $this->initialCode ? true : false; // untuk kondisi apakah input code checked

        $this->position_ids = $this->attendance->positions()->pluck('positions.id', 'positions.id')->toArray();
    }

    public function save()
    {
        // filter value before validate (ambil yang hanya checked)
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

        $attendance = [];
        if (!$this->attendance->code) {
            $this->attendance->code = null;
            $attendance = $this->attendance->toArray();
        } else {
            $attendance = $this->attendance->toArray();
            // generate code baru jika sebelumnya attendance menggunakan button (atau diubah)
            if (!$this->initialCode) {
                $attendance['code'] = Str::random();
            } else {
                $attendance['code'] = $this->initialCode;
            }
        }

        $this->attendance->update($attendance);
        $this->attendance->positions()->sync($position_ids);

        redirect()->route('attendances.index')->with('success', "Data absensi berhasil diubah.");
    }

    public function render()
    {
        return view('livewire.attendance-edit-form');
    }
}

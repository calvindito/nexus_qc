<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingHoursTypeDetail extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'working_hours_type_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'working_hours_type_id',
        'work_start_time',
        'work_end_time',
        'break_start_time',
        'break_end_time',
        'status'
    ];

    public function differenceTime()
    {
        $work_start_time  = Carbon::parse($this->work_start_time);
        $work_end_time    = Carbon::parse($this->work_end_time);
        $break_start_time = Carbon::parse($this->break_start_time);
        $break_end_time   = Carbon::parse($this->break_end_time);

        $work_minute  = $work_start_time->diffInMinutes($work_end_time, true);
        $break_minute = $break_start_time->diffInMinutes($break_end_time, true);

        $working_hour   = floor(($work_minute - $break_minute) / 60);
        $working_minute = floor(($work_minute - $break_minute) % 60);
        $break_hour     = floor($break_minute / 60);
        $break_minute   = floor($break_minute % 60);
        $all_hour       = floor($work_minute / 60);
        $all_minute     = floor($work_minute % 60);

        return (object)[
            'working' => [$working_hour, $working_minute],
            'break'   => [$break_hour, $break_minute],
            'all'     => [$all_hour, $all_minute]
        ];
    }

    public function workingHoursType()
    {
        return $this->belongsTo('App\Models\WorkingHoursType')->withTrashed();
    }

    public function status()
    {
        switch($this->status) {
            case '1':
                $status = 'Workday';
                break;
            case '2':
                $status = 'Holiday';
                break;
            default:
                $status = 'Invalid';
                break;
        }

        return $status;
    }

}

<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkingHoursType extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'working_hours_types';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'created_by',
        'updated_by',
        'name',
        'total_working_day',
        'late_tolerance',
        'status'
    ];

    public function totalHours()
    {
        $total_work_hour  = 0;
        $total_break_hour = 0;
        $total_all_hour   = 0;

        foreach($this->workingHoursTypeDetail as $whtd) {
            $work_start_time  = Carbon::parse($whtd->work_start_time);
            $work_end_time    = Carbon::parse($whtd->work_end_time);
            $break_start_time = Carbon::parse($whtd->break_start_time);
            $break_end_time   = Carbon::parse($whtd->break_end_time);

            $work_hour    = $work_start_time->diffInHours($work_end_time, false);
            $work_minute  = $work_start_time->diffInMinutes($work_end_time);
            $break_hour   = $break_start_time->diffInHours($break_end_time, false);
            $break_minute = $break_start_time->diffInMinutes($break_end_time);

            $total_work_hour  += $work_hour - $break_hour;
            $total_break_hour += $break_hour;
            $total_all_hour   += $work_hour;
        }

        return (object)[
            'working' => $total_work_hour,
            'break'   => $total_break_hour,
            'all'     => $total_all_hour
        ];
    }

    public function hasRelation()
    {
        if($this->workingHoursChart()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function workingHoursChart()
    {
        return $this->hasMany('App\Models\WorkingHoursChart');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id')->withTrashed();
    }

    public function status()
    {
        switch($this->status) {
            case '1':
                $status = '<span class="badge badge-success">Active</span>';
                break;
            case '2':
                $status = '<span class="badge badge-danger">Inactive</span>';
                break;
            default:
                $status = '<span class="badge badge-warning">Invalid</span>';
                break;
        }

        return $status;
    }

    public function workingHoursTypeDetail()
    {
        return $this->hasMany('App\Models\WorkingHoursTypeDetail');
    }

}

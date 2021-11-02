<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHoursTypeDetail extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'working_hours_type_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'working_hours_type_id',
        'start_time',
        'end_time',
        'shift',
        'duration',
        'order_sequence',
        'total_minutes'
    ];

    public function workingHoursType()
    {
        return $this->belongsTo('App\Models\WorkingHoursType')->withTrashed();
    }

    public function shift()
    {
        switch($this->shift) {
            case '1':
                $shift = 'Work';
                break;
            case '2':
                $shift = 'Break';
                break;
            default:
                $shift = 'Invalid';
                break;
        }

        return $shift;
    }

}

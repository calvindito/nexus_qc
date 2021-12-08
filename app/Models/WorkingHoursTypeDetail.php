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
        'status'
    ];

    public function workingHoursType()
    {
        return $this->belongsTo('App\Models\WorkingHoursType')->withTrashed();
    }

    public function status()
    {
        switch($this->status) {
            case '1':
                $status = 'Work';
                break;
            case '2':
                $status = 'Break';
                break;
            default:
                $status = 'Invalid';
                break;
        }

        return $status;
    }

}

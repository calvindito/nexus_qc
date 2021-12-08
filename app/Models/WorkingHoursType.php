<?php

namespace App\Models;

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

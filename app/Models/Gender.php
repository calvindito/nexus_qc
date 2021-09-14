<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gender extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'genders';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'created_by',
        'updated_by',
        'name',
        'status'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }

    public function status()
    {
        switch($this->status) {
            case '1':
                $status = '<a href="javascript:void(0)" onclick="update(' . $this->id . ', 2)" class="badge badge-success">Active</a>';
                break;
            case '2':
                $status = '<a href="javascript:void(0)" onclick="update(' . $this->id . ', 1)" class="badge badge-danger">Not Active</a>';
                break;
            default:
                $status = '<span class="badge badge-warning">Invalid</span>';
                break;
        }

        return $status;
    }

}

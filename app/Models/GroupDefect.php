<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupDefect extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'group_defects';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'created_by',
        'updated_by',
        'code',
        'name',
        'parent_id',
        'type',
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

    public function parent()
    {
        return GroupDefect::find($this->parent_id);
    }

    public function type()
    {
        switch($this->type) {
            case '1':
                $type = 'Parent';
                break;
            case '2':
                $type = 'Sub Group';
                break;
            case '3':
                $type = 'Defect List';
                break;
            case '4':
                $type = 'Reject List';
                break;
            case '5':
                $type = 'Major Defect List';
                break;
            case '6':
                $type = 'Critical Defect List';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GroupDefect extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'group_defects';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'created_by',
        'updated_by',
        'name',
        'type',
        'status'
    ];

    public function hasRelation()
    {
        if($this->productTypeDefect()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function productTypeDefect()
    {
        return $this->hasMany('App\Models\ProductTypeDefect');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id')->withTrashed();
    }

    public function type()
    {
        switch($this->type) {
            case '1':
                $type = 'Parent';
                break;
            case '2':
                $type = 'Defect List';
                break;
            case '3':
                $type = 'Reject List';
                break;
            case '4':
                $type = 'Major Issues';
                break;
            case '5':
                $type = 'Critical Issues';
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

}

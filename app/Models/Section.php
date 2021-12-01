<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'sections';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'departement_id',
        'created_by',
        'updated_by',
        'name',
        'status'
    ];

    public function hasRelation()
    {
        if($this->line()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function line()
    {
        return $this->hasMany('App\Models\Line');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id')->withTrashed();
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
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

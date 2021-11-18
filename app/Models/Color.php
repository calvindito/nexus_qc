<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'colors';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'brand_id',
        'fabric_id',
        'created_by',
        'updated_by',
        'code',
        'name',
        'status'
    ];

    public function hasRelation()
    {
        if($this->salesOrderDetail()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function salesOrderDetail()
    {
        return $this->hasMany('App\Models\SalesOrderDetail');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand')->withTrashed();
    }

    public function fabric()
    {
        return $this->belongsTo('App\Models\Fabric')->withTrashed();
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

}

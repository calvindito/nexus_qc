<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Style extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'styles';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'product_type_id',
        'brand_id',
        'size_id',
        'created_by',
        'updated_by',
        'code',
        'name',
        'status'
    ];

    public function hasRelation()
    {
        if($this->salesOrder()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function salesOrder()
    {
        return $this->hasMany('App\Models\SalesOrder');
    }

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType')->withTrashed();
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand')->withTrashed();
    }

    public function size()
    {
        return $this->belongsTo('App\Models\Size')->withTrashed();
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

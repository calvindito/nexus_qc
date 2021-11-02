<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductType extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'product_types';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'product_class_id',
        'gender_id',
        'size_id',
        'created_by',
        'updated_by',
        'name',
        'smv_global',
        'description',
        'status'
    ];

    public function productClass()
    {
        return $this->belongsTo('App\Models\ProductClass')->withTrashed();
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender')->withTrashed();
    }

    public function size()
    {
        return $this->belongsTo('App\Models\Size')->withTrashed();
    }

    public function productTypeCheckPoint()
    {
        return $this->hasMany('App\Models\ProductTypeCheckPoint');
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

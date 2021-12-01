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
        'product_group_id',
        'created_by',
        'updated_by',
        'name',
        'smv_global',
        'description',
        'status'
    ];

    public function hasRelation()
    {
        if($this->style()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function style()
    {
        return $this->hasMany('App\Models\Style');
    }

    public function productClass()
    {
        return $this->belongsTo('App\Models\ProductClass')->withTrashed();
    }

    public function productGroup()
    {
        return $this->belongsTo('App\Models\ProductGroup')->withTrashed();
    }

    public function productTypePosition()
    {
        return $this->hasMany('App\Models\ProductTypePosition');
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

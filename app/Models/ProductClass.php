<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductClass extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'product_classes';
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
                $status = '<span class="badge badge-success">Active</span>';
                break;
            case '2':
                $status = '<span class="badge badge-danger">Not Active</span>';
                break;
            default:
                $status = '<span class="badge badge-warning">Invalid</span>';
                break;
        }

        return $status;
    }

    public function productClassDetail()
    {
        return $this->hasMany('App\Models\ProductClassDetail');
    }

}

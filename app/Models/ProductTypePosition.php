<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypePosition extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'product_type_positions';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'product_type_id',
        'position_id'
    ];

    public function hasRelation()
    {
        if($this->productTypeDefect()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType')->withTrashed();
    }

    public function position()
    {
        return $this->belongsTo('App\Models\Position')->withTrashed();
    }

    public function productTypeDefect()
    {
        return $this->hasMany('App\Models\ProductTypeDefect');
    }

}

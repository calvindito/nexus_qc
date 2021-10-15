<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeCheckPoint extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'product_type_check_points';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'product_type_id',
        'check_point_id'
    ];

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType');
    }

    public function checkPoint()
    {
        return $this->belongsTo('App\Models\CheckPoint');
    }

}

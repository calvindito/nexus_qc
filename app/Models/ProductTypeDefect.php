<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTypeDefect extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'product_type_defects';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'product_type_id',
        'product_type_position_id',
        'group_defect_id'
    ];

    public function productType()
    {
        return $this->belongsTo('App\Models\ProductType')->withTrashed();
    }

    public function productTypePosition()
    {
        return $this->belongsTo('App\Models\ProductTypePosition');
    }

    public function groupDefect()
    {
        return $this->belongsTo('App\Models\GroupDefect')->withTrashed();
    }

}

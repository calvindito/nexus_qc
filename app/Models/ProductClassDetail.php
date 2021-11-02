<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductClassDetail extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'product_class_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'product_class_id',
        'gender_id'
    ];

    public function productClass()
    {
        return $this->belongsTo('App\Models\ProductClass')->withTrashed();
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender')->withTrashed();
    }

}

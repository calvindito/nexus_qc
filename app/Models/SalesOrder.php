<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesOrder extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'sales_orders';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'buyer_id',
        'style_id',
        'city_id',
        'code',
        'price',
        'tax',
        'delivery_date'
    ];

    public function hasRelation()
    {
        return false;
    }

    public function buyer()
    {
        return $this->belongsTo('App\Models\Buyer')->withTrashed();
    }

    public function style()
    {
        return $this->belongsTo('App\Models\Style')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City')->withTrashed();
    }

    public function salesOrderDetail()
    {
        return $this->hasMany('App\Models\SalesOrderDetail');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderDetail extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'sales_order_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'sales_order_id',
        'color_id',
        'size_detail_id',
        'qty'
    ];

    public function salesOrder()
    {
        return $this->belongsTo('App\Models\SalesOrder');
    }

    public function color()
    {
        return $this->belongsTo('App\Models\Color')->withTrashed();
    }

    public function sizeDetail()
    {
        return $this->belongsTo('App\Models\SizeDetail');
    }

}

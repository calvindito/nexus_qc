<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasingDetail extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'purchasing_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'purchasing_id',
        'color_id',
        'size_detail_id',
        'qty'
    ];

    public function purchasing()
    {
        return $this->belongsTo('App\Models\Purchasing')->withTrashed();
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

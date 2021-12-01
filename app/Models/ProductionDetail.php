<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionDetail extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'production_details';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'production_id',
        'color_id',
        'size_detail_id',
        'qty'
    ];

    public function production()
    {
        return $this->belongsTo('App\Models\Production');
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

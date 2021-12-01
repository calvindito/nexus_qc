<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeDetail extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'size_details';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'size_id',
        'value'
    ];

    public function hasRelation()
    {
        if($this->productionDetail()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function size()
    {
        return $this->belongsTo('App\Models\Size')->withTrashed();
    }

    public function productionDetail()
    {
        return $this->hasMany('App\Models\ProductionDetail');
    }

}

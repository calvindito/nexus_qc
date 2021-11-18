<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'cities';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'province_id',
        'name',
        'latitude',
        'longitude'
    ];

    public function hasRelation()
    {
        if($this->buyer()->count() > 0 || $this->salesOrder()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buyer()
    {
        return $this->hasMany('App\Models\Buyer');
    }

    public function salesOrder()
    {
        return $this->hasMany('App\Models\SalesOrder');
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province')->withTrashed();
    }

}

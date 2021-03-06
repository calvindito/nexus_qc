<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'provinces';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'country_id',
        'name',
        'latitude',
        'longitude'
    ];

    public function hasRelation()
    {
        if($this->buyer()->count() > 0 || $this->city()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buyer()
    {
        return $this->hasMany('App\Models\Buyer');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country')->withTrashed();
    }

    public function city()
    {
        return $this->hasMany('App\Models\City')->withTrashed();
    }

}

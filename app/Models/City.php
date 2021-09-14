<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'cities';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'province_id',
        'name',
        'latitude',
        'longitude'
    ];

    public function province()
    {
        return $this->belongsTo('App\Models\Province');
    }

}

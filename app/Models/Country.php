<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'countries';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'code',
        'name'
    ];

    public function province()
    {
        return $this->hasMany('App\Models\Province');
    }

}

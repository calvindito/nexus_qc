<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'countries';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'code',
        'name'
    ];

    public function hasRelation()
    {
        if($this->buyer()->count() > 0 || $this->province()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function buyer()
    {
        return $this->hasMany('App\Models\Buyer');
    }

    public function province()
    {
        return $this->hasMany('App\Models\Province')->withTrashed();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buyer extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'buyers';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'country_id',
        'province_id',
        'city_id',
        'created_by',
        'updated_by',
        'company',
        'description',
        'remark',
        'address',
        'status'
    ];

    public function hasRelation()
    {
        if($this->purchasing()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function purchasing()
    {
        return $this->hasMany('App\Models\Purchasing');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country')->withTrashed();
    }

    public function province()
    {
        return $this->belongsTo('App\Models\Province')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id')->withTrashed();
    }

    public function buyerContact()
    {
        return $this->hasMany('App\Models\BuyerContact');
    }

    public function status()
    {
        switch($this->status) {
            case '1':
                $status = '<span class="badge badge-success">Active</span>';
                break;
            case '2':
                $status = '<span class="badge badge-danger">Inactive</span>';
                break;
            default:
                $status = '<span class="badge badge-warning">Invalid</span>';
                break;
        }

        return $status;
    }

}

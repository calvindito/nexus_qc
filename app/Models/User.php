<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'created_by',
        'updated_by',
        'image',
        'username',
        'name',
        'email',
        'gender',
        'password',
        'tfa',
        'last_login',
        'status'
    ];

    public function hasRelation()
    {
        return false;
    }

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id')->withTrashed();
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id')->withTrashed();
    }

    public function image()
    {
        if($this->image && Storage::exists($this->image)) {
            $image = asset(Storage::url($this->image));
        } else {
            $image = asset('website/profile.png');
        }

        return $image;
    }

    public function gender()
    {
        switch($this->gender) {
            case '1':
                $gender = 'Male';
                break;
            case '2':
                $gender = 'Female';
                break;
            default:
                $gender = 'Invalid';
                break;
        }

        return $gender;
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

    public function token()
    {
        return $this->hasMany('App\Models\Token');
    }

}

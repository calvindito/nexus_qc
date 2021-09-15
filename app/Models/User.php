<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model {

    use HasFactory, SoftDeletes;

    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'created_by',
        'updated_by',
        'image',
        'username',
        'name',
        'gender',
        'password',
        'status'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
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
                $status = '<span class="badge badge-danger">Not Active</span>';
                break;
            default:
                $status = '<span class="badge badge-warning">Invalid</span>';
                break;
        }

        return $status;
    }

}

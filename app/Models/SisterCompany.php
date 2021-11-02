<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisterCompany extends Model {

    use HasFactory;

    protected $connection = 'asset';
    protected $table      = 'location_sister_company';

    public function sisterBranch()
    {
        return $this->hasMany('App\Models\SisterBranch', 'idsistercompany', 'id');
    }

}

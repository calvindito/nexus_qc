<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisterBranch extends Model {

    use HasFactory;

    protected $connection = 'asset';
    protected $table      = 'location_setup_sister_branch';

    public function division()
    {
        return $this->hasMany('App\Models\Division', 'id_branch', 'idsetupsisterbranch');
    }

}

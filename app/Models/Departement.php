<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model {

    use HasFactory;

    protected $connection = 'asset';
    protected $table      = 'department';

    public function division()
    {
        return $this->belongsTo('App\Models\Division', 'iddivisi', 'id');
    }

    public function section()
    {
        return $this->hasMany('App\Models\Section');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model {

    use HasFactory;

    protected $connection = 'asset';
    protected $table      = 'divisi';

    public function departement()
    {
        return $this->hasMany('App\Models\Departement', 'iddivisi', 'id');
    }

}

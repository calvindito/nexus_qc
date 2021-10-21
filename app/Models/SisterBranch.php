<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisterBranch extends Model {

    use HasFactory;

    protected $connection = 'asset';
    protected $table      = 'location_setup_sister_branch';

}

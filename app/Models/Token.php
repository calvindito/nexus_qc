<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'tokens';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'user_id',
        'code',
        'valid_at',
        'activated'
    ];

}

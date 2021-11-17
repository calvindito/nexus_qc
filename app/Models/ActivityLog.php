<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'activity_logs';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'causer_id', 'id')->withTrashed();
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerContact extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'buyer_contacts';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'buyer_id',
        'rank_id',
        'name',
        'value',
        'type'
    ];

    public function buyer()
    {
        return $this->belongsTo('App\Models\Buyer')->withTrashed();
    }

    public function rank()
    {
        return $this->belongsTo('App\Models\Rank');
    }

    public function type()
    {
        switch($this->type) {
            case '1':
                $type = 'Office';
                break;
            case '2':
                $type = 'HP';
                break;
            case '3':
                $type = 'Fax';
                break;
            case '4':
                $type = 'Email';
                break;
            default:
                $type = 'Invalid';
                break;
        }

        return $type;
    }

}

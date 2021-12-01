<?php

namespace App\Models;

use App\Models\Style;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Production extends Model {

    use HasFactory, SoftDeletes;

    protected $connection = 'mysql';
    protected $table      = 'productions';
    protected $primaryKey = 'id';
    protected $dates      = ['deleted_at'];
    protected $fillable   = [
        'buyer_id',
        'style_id',
        'city_id',
        'code_production',
        'code_job_order',
        'code_buyer',
        'delivery_date'
    ];

    public function hasRelation()
    {
        return false;
    }

    public function generateCodeProduction($param, $code = null)
    {
        $style = Style::find($param->style_id);
        $date  = explode('-', $param->delivery_date);
        $query = Production::orderBy('code', 'desc')->limit(1)->withTrashed()->get();

        if($code) {
            $breakdown = explode('-', $code);
            $nomor     = end($breakdown);
        } else {
            if($query->count() > 0) {
                $nomor = (int)$query[0]->code + 1;
            } else {
                $nomor = '0001';
            }
        }

        $brand_code = sprintf('%03s', $brand->buyer_id);
        $class_code = sprintf('%03s', $style->productType->product_class_id);
        $year       = $date[0];
        $month      = $date[1];

        return $brand_code . '-' . $class_code . '-' . $year . '-' . $month . '-' . $nomor;
    }

    public function buyer()
    {
        return $this->belongsTo('App\Models\Buyer')->withTrashed();
    }

    public function style()
    {
        return $this->belongsTo('App\Models\Style')->withTrashed();
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City')->withTrashed();
    }

    public function productionDetail()
    {
        return $this->hasMany('App\Models\ProductionDetail');
    }

}

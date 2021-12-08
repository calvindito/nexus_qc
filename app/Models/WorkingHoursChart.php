<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingHoursChart extends Model {

    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'working_hours_charts';
    protected $primaryKey = 'id';
    protected $fillable   = [
        'working_hours_type_id',
        'company_id',
        'branch_id',
        'division_id',
        'departement_id',
        'section_id',
        'line_id',
        'start_date',
        'end_date'
    ];

    public function hasRelation()
    {
        return false;
    }

    public function workingHoursType()
    {
        return $this->belongsTo('App\Models\WorkingHoursType');
    }

    public function company()
    {
        return $this->belongsTo('App\Models\SisterCompany');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\SisterBranch', 'branch_id', 'idsetupsisterbranch');
    }

    public function division()
    {
        return $this->belongsTo('App\Models\Division');
    }

    public function departement()
    {
        return $this->belongsTo('App\Models\Departement');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function line()
    {
        return $this->belongsTo('App\Models\Line');
    }

}

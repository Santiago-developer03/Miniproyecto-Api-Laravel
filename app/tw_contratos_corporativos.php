<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tw_contratos_corporativos extends Model
{

    protected $fillable = [
        'D_FechaInicio',
        'D_FechaFin',
        'URLContrato',
    ];

    public function tw_corporativos()
    {
        return $this->belongsTo(tw_corporativos::class);
    } 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tw_empresas_corporativos extends Model
{

    protected $fillable = [
        'S_RazonSocial',
        'S_RFC',
        'S_Pais',
        'S_Estado',
        'S_Municipio',
        'S_ColoniaLocalidad',
        'S_Domicilio',
        'S_CodigoPostal',
        'S_UsoCFDI',
        'S_UrlRFC',
        'S_UrlActaConstitutiva',
        'S_Activo',
        'Comentarios',
    ];

      public function tw_corporativos()
    {
        return $this->belongsTo(tw_corporativos::class);
    }
}

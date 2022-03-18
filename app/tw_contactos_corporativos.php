<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tw_contactos_corporativos extends Model
{

    protected $fillable = [
        'S_Nombre',
        'S_Puesto',
        'S_Comentarios',
        'N_Portafolio',
        'N_Telefonofijo',
        'N_TelefonoMovil',
        'S_Email',
    ];

    public function tw_corporativos()
    {
        return $this->belongsTo(tw_corporativos::class);
    } 
}

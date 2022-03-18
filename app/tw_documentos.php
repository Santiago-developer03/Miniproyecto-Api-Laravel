<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tw_documentos extends Model
{
    
    protected $fillable  = [
        'S_Nombre',
        'N_Obligatorio',
        'S_Descripcion',
    ];
}

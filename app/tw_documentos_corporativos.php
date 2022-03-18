<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tw_documentos_corporativos extends Model
{

    protected $fillable = [
        'S_ArchivoUrl',
        'tw_corporativos_id',
        'tw_documentos_id',
    ];

    public function tw_corporativos()
    {
        return $this->belongsTo(tw_corporativos::class);
    } 

    public function tw_documentos()
    {
        return $this->hasMany(tw_documentos::class);
    }
}

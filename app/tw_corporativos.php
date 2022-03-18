<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tw_corporativos extends Model
{

    protected $fillable = [
        'S_NombreCorto',
        'S_NombreCompleto',
        'S_LogoURL',
        'S_DBName',
        'S_DBUsuarios',
        'S_DBPassword',
        'S_SystemUrl',
        'S_activo',
        'users_id'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

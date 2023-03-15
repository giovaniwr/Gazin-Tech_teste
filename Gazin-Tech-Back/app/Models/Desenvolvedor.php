<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{
    use HasFactory;
    protected $atributes =
    [
        'nivelId',
        'nome',
        'sexo',
        'datanascimento',
        'idade',
        'hobby'
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivelId','id');
    }


}

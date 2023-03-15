<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    protected $appends =
        [
            'totalDev'
        ];
    protected $atributes =
        [
            'nivel'
        ];

    public function desenvolvedores()
    {
        return $this->hasMany(Desenvolvedor::class, "nivelId","id");
    }
    public function getTotalDevAttribute(){
        return $this->desenvolvedores()->count();
    }

}

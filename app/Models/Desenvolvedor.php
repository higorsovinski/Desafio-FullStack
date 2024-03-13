<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desenvolvedor extends Model
{

    use HasFactory;

    protected $table = 'desenvolvedores';

    protected $fillable = [
        'nivel_id',
        'nome',
        'sexo',
        'datanascimento',
        'hobby'
    ];

    public function nivel()
    {
        return $this->belongsTo(Nivel::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgClassificacao extends Model
{
     use HasFactory;
     protected $table = 'AG_CLASSIFICACAO';
     protected $primaryKey = 'AG_CLASSIFICACAO';

     public function agquestoes()
     {
          return $this->hasMany(AgFormRespostas::class, 'AG_CLASSIFICACAO', 'AG_CLASSIFICACAO');
     }
}

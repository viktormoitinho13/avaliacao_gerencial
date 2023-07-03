<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AgResposta;

class AgQuestoes extends Model
{
     use HasFactory;
     protected $table = 'Ag_questoes';
     protected $primaryKey = 'ag_questao';

     public function respostas()
     {
          return $this->hasMany(AgResposta::class, 'AG_QUESTAO', 'AG_QUESTAO');
     }
}
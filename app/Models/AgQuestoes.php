<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgQuestoes extends Model
{
     use HasFactory;
     protected $table = 'Ag_questoes';
     protected $primaryKey = 'ag_questao';
}
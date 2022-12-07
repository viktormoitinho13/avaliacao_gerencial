<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgGerente extends Model
{
     use HasFactory;
     protected $table = 'GERENTES_LOJAS';
     protected $primaryKey = 'GERENTE_LOJA';
}
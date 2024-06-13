<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgGerente extends Model
{
     use HasFactory;

     /**
      * @var string
      */
     protected $table = 'vw_historico_gerentes';


     /**
      * @var string
      */
     protected $primaryKey = 'GERENTE_LOJA';

     /**
      * @var array
      */
     protected $fillable = [
          'GERENTE_LOJA',
          'SUPERVISOR',
          'NOME_SUPERVISOR',
          'GERENTE_ATUAL',
          'NOME',
          'LOJA',
          'DATA_ENTRADA',
          'DATA_SAIDA'
     ];


     /**
      * @var bool
      */
     public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgFormRespostas extends Model
{
     use HasFactory;

     /**
      * @var string
      */
     protected $table = 'AG_FORM_RESPOSTAS';

     /**
      * @var string
      */
     protected $primaryKey = 'AG_FORM_RESPOSTA';

     /**
      * @var array
      */
     protected $fillable = [
          'FORMULARIO_ORIGEM',
          'TAB_MASTER_ORIGEM',
          'REG_MASTER_ORIGEM',
          'REG_LOG_INCLUSAO',
          'AG_RESPOSTA',
          'AG_RESPOSTA_DESCRICAO',
          'AG_CLASSIFICACAO',
          'AG_QUESTAO',
          'AG_USUARIO',
          'AG_MATRICULA',
          'DATA_RESPOSTAS',
          'AG_LOJA',
          'DATA_RESPOSTA_COMPLETA'
     ];

     /**
      * @var bool
      */
     public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgSupervisorObservacao extends Model
{
     use HasFactory;
     protected $table = 'AG_SUPERVISORES_OBSERVACOES';
     protected $primaryKey = 'AG_SUPERVISOR_OBSERVACAO';

     protected $fillable = [
          'FORMULARIO_ORIGEM',
          'TAB_MASTER_ORIGEM',
          'REG_MASTER_ORIGEM',
          'REG_LOG_INCLUSAO',
          'AG_SUPERVISOR_OBSERVACAO',
          'DATA_MOVIMENTO',
          'LOJA',
          'OBSERVACAO',
          'AVALIACAO_DATA'
     ];

     public $timestamps = false;
}
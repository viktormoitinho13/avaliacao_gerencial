<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgStatus extends Model
{
    use HasFactory;
    protected $table = 'AG_STATUS';
    protected $primaryKey = 'ag_status';

    protected $fillable = [
        'FORMULARIO_ORIGEM',
        'TAB_MASTER_ORIGEM',
        'REG_MASTER_ORIGEM',
        'REG_LOG_INCLUSAO',
        'AG_CLASSIFICACAO',
        'AG_USUARIO',
        'AG_MATRICULA',
        'AG_DATA'

    ];

       /**
      * @var bool
      */
     public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgClassificacao extends Model
{
     use HasFactory;

     /**
      * @var string
      */
     protected $table = 'AG_CLASSIFICACAO';

     /**
      * @var string
      */
     protected $primaryKey = 'AG_CLASSIFICACAO';

     /**
      * @var array
      */
     protected $guarded = ['AG_CLASSIFICACAO'];

     /**
      * @return HasMany
      */
     public function agquestoes()
     {
          return $this->hasOne(AgFormRespostas::class, 'AG_CLASSIFICACAO', 'AG_CLASSIFICACAO');
     }
}

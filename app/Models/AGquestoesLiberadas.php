<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AGquestoesLiberadas extends Model
{
    use HasFactory;
    /**
     * @var string
     */
    protected $table = "AG_LIBERACAO_QUESTOES_MENSAIS";

    /**
     * @var string
     */
    protected $primaryKey = "AG_LIBERACAO_QUESTAO_MENSAL";

    /**
     * @var array
     */
    protected $guarded = [
        "AG_LIBERACAO_QUESTAO_MENSAL"

    ];

    /**
     * @var bool
     */
    public $timestamps = false;
}

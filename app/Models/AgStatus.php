<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'DATA_RESPOSTA_COMPLETA',
        'AG_DATA',
        'AG_LOJA'

    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @param [type] $builder
     * @param integer $usuarioId
     * @return Builder
     */
    public function scopeUsuarioId(Builder $builder, int $usuarioId): Builder
    {
        return $builder->where('AG_USUARIO', $usuarioId);
    }
}

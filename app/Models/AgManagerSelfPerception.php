<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgManagerSelfPerception extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'AG_FEEDBACK_AUTO_PERCEPCAO_GERENTES';



    /**
     * @var string
     */
    protected $primaryKey = "AG_FEEDBACK_AUTO_PERCEPCAO_GERENTE";



    /**
     * @var array
     */
    protected $guarded = [
        "AG_FEEDBACK_AUTO_PERCEPCAO_GERENTE"

    ];
    /**
     * @var bool
     */
    public $timestamps = false;
}

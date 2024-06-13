<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgFeedbackSupervisaoDetail extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO_DETAIL';



    /**
     * @var string
     */
    protected $primaryKey = "AG_FEEDBACK_SEMESTRAL_SUPERVISAO_DETAIL";



    /**
     * @var array
     */
    protected $guarded = [
        "AG_FEEDBACK_SEMESTRAL_SUPERVISAO_DETAIL"

    ];
    /**
     * @var bool
     */
    public $timestamps = false;
}

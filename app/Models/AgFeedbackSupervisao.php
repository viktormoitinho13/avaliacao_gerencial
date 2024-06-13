<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgFeedbackSupervisao extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'AG_FEEDBACK_SEMESTRAIS_SUPERVISAO';



    /**
     * @var string
     */
    protected $primaryKey = "AG_FEEDBACK_SEMESTRAL_SUPERVISAO";



    /**
     * @var array
     */
    protected $guarded = [
        "AG_FEEDBACK_SEMESTRAL_SUPERVISAO"

    ];
    /**
     * @var bool
     */
    public $timestamps = false;
}

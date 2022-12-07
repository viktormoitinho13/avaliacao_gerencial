<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgVendedor extends Model
{
      use HasFactory;
     protected $table = 'VENDEDORES';
     protected $primaryKey = 'VENDEDORs';
}
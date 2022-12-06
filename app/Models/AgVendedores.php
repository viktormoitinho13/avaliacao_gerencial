<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class AgVendedores extends Model
{
     use HasFactory;
     protected $table = 'VENDEDORES';
     protected $primaryKey = 'VENDEDOR';

     public function AgVendedores()
     {
          return $this->hasMany(User::class, 'VENDEDOR', 'REGISTRATION');
     }
}
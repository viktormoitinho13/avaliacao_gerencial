<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateAgusuariosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ag_usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('password');
            $table->string('registration');
            $table->integer('store');
            $table->string('manager')->nullable();
            $table->rememberToken();
            $table->timestamps = now();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ag_usuarios');
    }
}
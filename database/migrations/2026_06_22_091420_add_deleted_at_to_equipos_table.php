<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('equipos', function (Blueprint $table) {
            //Crea la columna 'deleted_at'
            $table->softDeletes(); 
        });
    }

    public function down()
    {
        Schema::table('equipos', function (Blueprint $table) {
            //Esto la elimina si nos arrepentimos
            $table->dropSoftDeletes(); 
        });
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixImagenColumnInPlatosTable extends Migration
{
    public function up()
    {
        Schema::table('platos', function (Blueprint $table) {
            // Cambiar la columna imagen para que sea nullable y sin valor por defecto
            $table->string('imagen')->nullable()->default(null)->change();
        });
    }

    public function down()
    {
        Schema::table('platos', function (Blueprint $table) {
            // Revertir cambios si es necesario
            $table->string('imagen')->nullable()->change();
        });
    }
}

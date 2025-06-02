<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImagenToPlatosTable extends Migration
{
    public function up()
    {
        if (!Schema::hasColumn('platos', 'imagen')) {
            Schema::table('platos', function (Blueprint $table) {
                $table->string('imagen')->nullable()->after('precio')->default(null);
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('platos', 'imagen')) {
            Schema::table('platos', function (Blueprint $table) {
                $table->dropColumn('imagen');
            });
        }
    }
}

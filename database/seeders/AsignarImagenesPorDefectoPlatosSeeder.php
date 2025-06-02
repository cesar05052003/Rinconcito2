<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsignarImagenesPorDefectoPlatosSeeder extends Seeder
{
    public function run()
    {
        // Asignar una imagen por defecto a los platos que no tienen imagen
        DB::table('platos')
            ->whereNull('imagen')
            ->orWhere('imagen', '')
            ->update(['imagen' => 'images/default.png']);
    }
}

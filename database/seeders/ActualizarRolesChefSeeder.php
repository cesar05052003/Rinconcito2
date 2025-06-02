<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActualizarRolesChefSeeder extends Seeder
{
    public function run()
    {
        // Actualizar el campo 'role' a 'chef' para los usuarios cuyo 'tipo_usuario' es 'chef'
        DB::table('users')
            ->where('tipo_usuario', 'chef')
            ->update(['role' => 'chef']);
    }
}

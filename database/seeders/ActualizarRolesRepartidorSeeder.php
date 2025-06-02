<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ActualizarRolesRepartidorSeeder extends Seeder
{
    public function run()
    {
        // Actualizar el campo 'role' a 'repartidor' para los usuarios cuyo 'tipo_usuario' es 'repartidor'
        DB::table('users')
            ->where('tipo_usuario', 'repartidor')
            ->update(['role' => 'repartidor']);
    }
}

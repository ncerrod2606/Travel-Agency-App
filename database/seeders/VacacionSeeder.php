<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Tipo;
use App\Models\Vacacion;
use App\Models\Foto;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VacacionSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@travel.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
             'email_verified_at' => now(),
        ]);
        
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@travel.com',
            'password' => Hash::make('password'),
            'rol' => 'user',
            'email_verified_at' => now(),
        ]);

        $playa = Tipo::create(['nombre' => 'Playa']);
        $montana = Tipo::create(['nombre' => 'Montaña']);
        $ciudad = Tipo::create(['nombre' => 'Ciudad']);
        $crucero = Tipo::create(['nombre' => 'Crucero']);

        $v1 = Vacacion::create([
            'titulo' => 'Caribe Relax',
            'descripcion' => 'Disfruta de las mejores playas del Caribe con todo incluido. Un paraíso terrenal te espera.',
            'precio' => 1200.50,
            'idtipo' => $playa->id,
            'pais' => 'República Dominicana'
        ]);
        Foto::create(['ruta' => 'assets/img/vacacion/caribe.png', 'idvacacion' => $v1->id]);

        $v2 = Vacacion::create([
            'titulo' => 'Alpes Suizos',
            'descripcion' => 'Aventura en la nieve y paisajes impresionantes en los Alpes.',
            'precio' => 1500.00,
            'idtipo' => $montana->id,
            'pais' => 'Suiza'
        ]);
        Foto::create(['ruta' => 'assets/img/vacacion/alpes.png', 'idvacacion' => $v2->id]);

        $v3 = Vacacion::create([
            'titulo' => 'Tour por París',
            'descripcion' => 'Visita la ciudad del amor, la torre Eiffel y el museo del Louvre.',
            'precio' => 900.00,
            'idtipo' => $ciudad->id,
            'pais' => 'Francia'
        ]);
        Foto::create(['ruta' => 'assets/img/vacacion/paris.png', 'idvacacion' => $v3->id]);
        
        $v4 = Vacacion::create([
            'titulo' => 'Mediterráneo de Lujo',
            'descripcion' => 'Recorre el mediterráneo en un crucero de 5 estrellas.',
            'precio' => 2200.00,
            'idtipo' => $crucero->id,
            'pais' => 'Italia/España'
        ]);
        Foto::create(['ruta' => 'assets/img/vacacion/mediterraneo.png', 'idvacacion' => $v4->id]);
    }
}

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
        $admin = User::firstOrCreate(
            ['email' => 'admin@travel.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'rol' => 'admin',
                'email_verified_at' => now(),
            ]
        );
        
        $user = User::firstOrCreate(
            ['email' => 'user@travel.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'rol' => 'user',
                'email_verified_at' => now(),
            ]
        );

        $playa = Tipo::firstOrCreate(['nombre' => 'Playa']);
        $montana = Tipo::firstOrCreate(['nombre' => 'Montaña']);
        $ciudad = Tipo::firstOrCreate(['nombre' => 'Ciudad']);
        $crucero = Tipo::firstOrCreate(['nombre' => 'Crucero']);

        $v1 = Vacacion::firstOrCreate(['titulo' => 'Caribe Relax'], [
            'descripcion' => 'Disfruta de las mejores playas del Caribe con todo incluido. Un paraíso terrenal te espera.',
            'precio' => 1200.50,
            'idtipo' => $playa->id,
            'pais' => 'República Dominicana'
        ]);
        Foto::firstOrCreate(['ruta' => 'assets/img/vacacion/caribe.png', 'idvacacion' => $v1->id]);

        $v2 = Vacacion::firstOrCreate(['titulo' => 'Alpes Suizos'], [
            'descripcion' => 'Aventura en la nieve y paisajes impresionantes en los Alpes.',
            'precio' => 1500.00,
            'idtipo' => $montana->id,
            'pais' => 'Suiza'
        ]);
        Foto::firstOrCreate(['ruta' => 'assets/img/vacacion/alpes.png', 'idvacacion' => $v2->id]);

        $v3 = Vacacion::firstOrCreate(['titulo' => 'Tour por París'], [
            'descripcion' => 'Visita la ciudad del amor, la torre Eiffel y el museo del Louvre.',
            'precio' => 900.00,
            'idtipo' => $ciudad->id,
            'pais' => 'Francia'
        ]);
        Foto::firstOrCreate(['ruta' => 'assets/img/vacacion/paris.png', 'idvacacion' => $v3->id]);
        
        $v4 = Vacacion::firstOrCreate(['titulo' => 'Mediterráneo de Lujo'], [
            'descripcion' => 'Recorre el mediterráneo en un crucero de 5 estrellas.',
            'precio' => 2200.00,
            'idtipo' => $crucero->id,
            'pais' => 'Italia/España'
        ]);
        Foto::firstOrCreate(['ruta' => 'assets/img/vacacion/mediterraneo.png', 'idvacacion' => $v4->id]);

        // Generate 15 more dummy vacations for pagination testing
        for ($i = 1; $i <= 15; $i++) {
             $vac = Vacacion::create([
                'titulo' => 'Vacación Dummy ' . $i,
                'descripcion' => 'Descripción de prueba para la vacación número ' . $i,
                'precio' => rand(500, 3000),
                'idtipo' => rand($playa->id, $crucero->id),
                'pais' => 'País Dummy ' . $i
            ]);
            // Assign random existing image to dummy vacations
            $randomImage = 'assets/img/vacacion/' . ['caribe.png', 'alpes.png', 'paris.png', 'mediterraneo.png'][rand(0, 3)];
            Foto::create(['ruta' => $randomImage, 'idvacacion' => $vac->id]);
            
            // Create random reservation and comment for some vacations
            if($i % 2 == 0) {
                 \App\Models\Reserva::create([
                    'iduser' => $user->id,
                    'idvacacion' => $vac->id
                ]);
                \App\Models\Comentario::create([
                    'iduser' => $user->id,
                    'idvacacion' => $vac->id,
                    'texto' => 'Excelente experiencia, muy recomendado. El paisaje era increíble.'
                ]);
            }
        }
    }
}

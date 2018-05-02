<?php

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'lat' => 19,
            'lng' => -98.244,
            'name' => 'Escuela',
            'address' => 'Reserva Territorial Atlixcayotl',
            'user_id' => 1
        ]);

        DB::table('locations')->insert([
            'lat' => 19.02,
            'lng' => -98.21,
            'name' => 'Casa',
            'address' => 'Calle 7A',
            'user_id' => 1
        ]);
    }
}

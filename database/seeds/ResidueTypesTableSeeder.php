<?php

use Illuminate\Database\Seeder;

class ResidueTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('residue_types')->insert([
        	'name' => 'PET',
        	'description' => 'Botellas de plástico, frascos de plástico, cintas de video, radiografías, etc',
        	'image' => 'pet.png',
        ]);

        DB::table('residue_types')->insert([
        	'name' => 'Papel/Carton',
        	'description' => 'Carton, hojas de papel, servilletas, toallas de papel, etc. PAPEL DE BAÑO NO',
        	'image' => 'carton.png',
        ]);

        DB::table('residue_types')->insert([
        	'name' => 'Aluminio',
        	'description' => 'Papel aluminio, latas de refresco, latas de no perecederos, bandejas de aluminio, etc',
        	'image' => 'aluminio.png',
        ]);

        DB::table('residue_types')->insert([
        	'name' => 'Vidrio',
        	'description' => 'Botellas de cristal, tarros de cristal, vasos, etc. NINGUN TIPO DE CONTENEDOR CON RESIDUOS PELIGROSOS',
        	'image' => 'cristal.png',
        ]);
    }
}

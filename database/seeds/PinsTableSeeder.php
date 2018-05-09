<?php

use Illuminate\Database\Seeder;

class PinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pins')->insert([
            'residue_type_id' => 1,
            'location_id' => 1,
            'user_id' => 1,
            'created_at' => '2000-01-01',
            'updated_at' => '2000-01-01'
        ]);
    }
}

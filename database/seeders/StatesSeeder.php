<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('states')->insert([
            'name' => 'Minas Gerais',
            'slug' => 'MG'
        ]);

        DB::table('states')->insert([
            'name' => 'Espirito Santo',
            'slug' => 'ES'
        ]);

        DB::table('states')->insert([
            'name' => 'Paraná',
            'slug' => 'PR'
        ]);

        DB::table('states')->insert([
            'name' => 'Santa Catarina',
            'slug' => 'SC'
        ]);

        DB::table('states')->insert([
            'name' => 'Rio Grande do Sul',
            'slug' => 'RS'
        ]);
    }
}

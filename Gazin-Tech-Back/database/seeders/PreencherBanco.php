<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PreencherBanco extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nivels')->insert([
            [
                'nivel' => 'Junior',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'nivel' => 'Pleno',
                'updated_at' => now(),
                'created_at' => now(),
            ],
            [
                'nivel' => 'Senior',
                'updated_at' => now(),
                'created_at' => now(),
            ],

        ]);
    }
}

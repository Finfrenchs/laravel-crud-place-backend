<?php

namespace Database\Seeders;

use App\Models\Places;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlacesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Places::factory()->count(10)->create();
    }
}

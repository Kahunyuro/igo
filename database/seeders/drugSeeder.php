<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\drug;
class drugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        drug::factory(10)->create();

        drug::factory()->create([
            'name' => 'Panadol',
            'description' => 'Painkiller',

            'price' => '20',
            'quantity' => '1000',
        ]);
    }
    }


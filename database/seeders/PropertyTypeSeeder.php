<?php

namespace Database\Seeders;

use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'ბინა'],
            ['name' => 'სახლი'],
            ['name' => 'ნაკვეთი'],
        ];
        PropertyType::insert($data);
    }
}

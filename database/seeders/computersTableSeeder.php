<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
class computersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 50) as $index) {
            DB::table('computers')->insert([
                'computer_name' => $faker->word . '-PC' . $index,
                'model' => $faker->word . ' ' . $faker->randomNumber(3),
                'operating_system' => 'Windows 10 Pro',
                'processor' => 'Intel Core i5-' . $faker->randomNumber(4),
                'memory' => $faker->randomElement([4, 8, 16, 32]),
                'available' => $faker->boolean,
            ]);
        }
    }
}

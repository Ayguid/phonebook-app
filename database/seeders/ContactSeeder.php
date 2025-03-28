<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Contact::create([
                'name' => $faker->name(),
                'phone_number' => $faker->numerify('+1 (###) ###-####'),
            ]);
        }
    }
}

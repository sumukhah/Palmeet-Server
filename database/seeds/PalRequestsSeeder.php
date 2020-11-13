<?php

use App\PalRequest;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PalRequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PalRequest::truncate();

        $faker = Factory::create();
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 12; $i++) {
            PalRequest::create([
                'user_id' => $faker->randomDigit,
                'email' => $faker->email,
                'pal_id' => $faker->randomDigit,
                'message' => $faker->paragraph,
                'status' => rand(-1,1)
            ]);
        }
    }
}

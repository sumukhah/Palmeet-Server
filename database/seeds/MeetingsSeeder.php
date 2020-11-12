<?php
use Faker\Factory;
use App\Meeting;
use Illuminate\Database\Seeder;

class MeetingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meeting::truncate();

        $faker = Factory::create();
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 12; $i++) {
            Meeting::create([
                'user_id' => $faker->randomDigit,
                'title' => $faker->sentence,
                'link' => $faker->url,
                'invitation' => $faker->paragraph,
                'meeting_starts' => $faker->dateTime,
                'meeting_ends' => $faker->dateTime,
            ]);
        }
    }
}

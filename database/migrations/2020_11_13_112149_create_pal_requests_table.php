<?php

use App\PalRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Faker\Factory;

class CreatePalRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pal_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id'); //Caller
            $table->string('email');//Receiver Email
            $table->integer('pal_id')->nullable();//Receiver
            $table->integer('status')->default(0);//1 accepted //reject -1
            $table->timestamps();
        });

        PalRequest::truncate();

        $faker = Factory::create();
        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 12; $i++) {
            PalRequest::create([
                'user_id' => $faker->randomDigit,
                'email' => $faker->email,
                'pal_id' => $faker->randomDigit,
                'invitation' => $faker->paragraph,
                'status' => rand(-1,1)
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pal_requests');
    }
}

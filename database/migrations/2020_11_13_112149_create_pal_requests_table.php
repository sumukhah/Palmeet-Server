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
            $table->text('message')->nullable();
            $table->timestamps();
        });

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

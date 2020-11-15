<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title');
            $table->text('invitation')->nullable();
            $table->string('link');
            $table->string('meeting_id')->nullable();
            $table->string('meeting_password')->nullable();
            $table->dateTime('meeting_starts');
            $table->dateTime('meeting_ends')->nullable();
            $table->integer('status')->default(0);//0 pending //1 started // 2 ended
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
        Schema::dropIfExists('meetings');
    }
}

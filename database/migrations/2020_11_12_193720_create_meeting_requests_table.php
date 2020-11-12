<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('meeting_id');
            $table->integer('user_id');
            $table->integer('acceptance_status')->default(0);//0 pending //1 accepted -1 rejected
            $table->integer('meeting_status')->default(0);//0 pending //1 in progress 2 ended
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
        Schema::dropIfExists('meeting_requests');
    }
}

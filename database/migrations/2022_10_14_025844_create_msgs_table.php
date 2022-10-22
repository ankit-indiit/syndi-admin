<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('msgs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('payload_id')->nullable();
            $table->string('room_id')->nullable();
            $table->string('sender_phone')->nullable();
            $table->string('sender_name')->nullable();
            $table->string('receiver_phone')->nullable();
            $table->string('receiver_name')->nullable();
            $table->text('message')->nullable();
            $table->boolean('read')->default(false);
            $table->dateTime('schedule')->nullable();
            $table->dateTime('occurred_at')->nullable();
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
        Schema::dropIfExists('msgs');
    }
}

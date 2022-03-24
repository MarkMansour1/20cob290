<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatBoxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_box', function (Blueprint $table) {
            $table->id();
            $table->foreignId('problem_id')->constrained('problem');
            $table->timestamps();
            $table->string('personnel_chat',255)->nullable();
            $table->string('specialist_chat',255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chat_box');
    }
}

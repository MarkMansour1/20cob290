<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpecialistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialist', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('personnel_id')->constrained('users');
            $table->integer('no_of_jobs');
            $table->boolean('status');
            //$table->date('next_in_work');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialist');
    }
}

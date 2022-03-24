<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProblemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problem', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('personnel_id')->constrained('users');
            $table->foreignId('specialist_id')->nullable()->constrained('specialist');
            $table->integer('branch');
            $table->date('date_submitted')->nullable();
            $table->timestamp('time_submitted')->nullable();
            $table->integer('status');
            $table->boolean('in_person');
            $table->foreignId('super_problem_type_id')->constrained('super_problem_type');
            $table->foreignId('sub_problem_type_id')->constrained('sub_problem_type');
            $table->string('problem_description', 255)->nullable();
            $table->date('date_solved')->nullable();
            $table->timestamp('time_solved')->nullable();
            $table->foreignId('solution_id')->nullable()->constrained('solution');
            $table->string('solution_notes', 255)->nullable();
            $table->string('os', 255)->nullable();
            $table->string('software'); //->constrained('software');
            $table->foreignId('serial_no'); //->constrained('equipment');
            //$table->foreignId('chat_id')->nullable()->constrained('chat_box');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problem');
    }
}

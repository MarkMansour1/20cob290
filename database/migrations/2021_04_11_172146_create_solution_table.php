<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solution', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('solution',255);
            $table->string('solution_description',255);
            $table->integer('times_used');
            $table->foreignId('sub_problem_type_id')->constrained('sub_problem_type');
            $table->foreignId('super_problem_type_id')->constrained('super_problem_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solution');
    }
}

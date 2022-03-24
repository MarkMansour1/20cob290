<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnel', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('email', 255);
            $table->string('password', 255);
            $table->string('name', 255);
            $table->string('job_title', 255);
            $table->string('telephone');
            $table->foreignId('branch_id')->constrained('branch');
            $table->string('department');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnel');
    }
}

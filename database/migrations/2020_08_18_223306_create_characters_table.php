<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCharactersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('gang_id')->nullable();
            $table->foreign('gang_id')->references('id')->on('gangs');

            $table->string('name');
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('status')->nullable()->default("Unknown");
            $table->text('cause_of_death')->nullable();
            $table->string('date_of_birth')->nullable()->default("Unknown");
            $table->string('date_of_death')->nullable();
            $table->string('nationality')->nullable();
            $table->string('voiced_by')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->text('artwork')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('characters');
    }
}

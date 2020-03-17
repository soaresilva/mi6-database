<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('image_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->integer('age')->nullable();
            $table->string('born')->nullable();
            $table->string('died')->nullable();
            $table->string('features')->nullable();
            $table->string('hair_color')->nullable();
            $table->string('eye_color')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('nationality')->nullable();
            $table->string('occupation')->nullable();
            $table->string('status_text')->nullable();
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
        Schema::dropIfExists('people');
    }
}

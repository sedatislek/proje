<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNationalAthletesTable extends Migration
{
    public function up()
    {
        Schema::create('national_athletes', function (Blueprint $table) {
            $table->id('athlete_id');
            $table->unsignedBigInteger('club_id')->nullable();
            $table->unsignedBigInteger('discipline_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('achievement_level', 100)->nullable();
            $table->integer('achievement_year')->nullable();
            $table->boolean('gives_extra_delegate')->default(true);
            $table->timestamps();

            $table->foreign('club_id')->references('club_id')->on('clubs')->onDelete('set null');
            $table->foreign('discipline_id')->references('discipline_id')->on('disciplines')->onDelete('set null');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('national_athletes');
    }
}

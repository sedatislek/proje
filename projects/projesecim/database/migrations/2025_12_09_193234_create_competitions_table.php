<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id('competition_id');
            $table->string('name', 255);
            $table->unsignedBigInteger('season_id')->nullable();
            $table->unsignedBigInteger('discipline_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('competition_type')->nullable();
            $table->boolean('is_team_event')->default(true);
            $table->timestamps();

            $table->foreign('season_id')->references('season_id')->on('seasons')->onDelete('set null');
            $table->foreign('discipline_id')->references('discipline_id')->on('disciplines')->onDelete('set null');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');

            $table->index('season_id');
            $table->index('discipline_id');
            $table->index('category_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('competitions');
    }
}

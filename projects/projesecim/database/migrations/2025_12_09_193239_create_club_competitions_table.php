<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubCompetitionsTable extends Migration
{
    public function up()
    {
        Schema::create('club_competitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('club_id');
            $table->unsignedBigInteger('competition_id');
            $table->boolean('participated')->default(true);
            $table->string('result', 100)->nullable();
            $table->timestamps();

            $table->foreign('club_id')->references('club_id')->on('clubs')->onDelete('cascade');
            $table->foreign('competition_id')->references('competition_id')->on('competitions')->onDelete('cascade');

            $table->index('club_id');
            $table->index('competition_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('club_competitions');
    }
}

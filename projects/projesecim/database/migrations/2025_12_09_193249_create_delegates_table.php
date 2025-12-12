<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDelegatesTable extends Migration
{
    public function up()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->id('delegate_id');
            $table->unsignedBigInteger('club_id')->nullable();
            $table->integer('season1')->nullable();
            $table->integer('season2')->nullable();
            $table->string('delegate_type', 50)->default('normal'); // normal, extra, ministry
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();

            $table->foreign('club_id')->references('club_id')->on('clubs')->onDelete('set null');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');

            $table->index(['club_id', 'category_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('delegates');
    }
}

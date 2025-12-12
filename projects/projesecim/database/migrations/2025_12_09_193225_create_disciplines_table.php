<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisciplinesTable extends Migration
{
    public function up()
    {
        Schema::create('disciplines', function (Blueprint $table) {
            $table->id('discipline_id');
            $table->string('name', 100);
            $table->boolean('is_olympic')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disciplines');
    }
}

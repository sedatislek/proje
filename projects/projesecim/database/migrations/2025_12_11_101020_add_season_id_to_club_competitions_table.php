<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('club_competitions', function (Blueprint $table) {
            if (!Schema::hasColumn('club_competitions', 'season_id')) {
                $table->unsignedBigInteger('season_id')->after('club_id');

                $table->foreign('season_id')
                    ->references('season_id')
                    ->on('seasons')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('club_competitions', function (Blueprint $table) {
            if (Schema::hasColumn('club_competitions', 'season_id')) {
                $table->dropForeign(['season_id']);
                $table->dropColumn('season_id');
            }
        });
    }
};

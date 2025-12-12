<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClubCompetition extends Model
{
    protected $table = 'club_competitions';

    protected $fillable = [
        'club_id',
        'season_id',
        'competition_id',
        'participated',
        'result',
    ];

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'club_id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id', 'competition_id');
    }

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id', 'season_id');
    }
}

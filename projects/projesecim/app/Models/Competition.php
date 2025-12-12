<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = 'competitions';
    protected $primaryKey = 'competition_id';

    protected $fillable = [
        'name',
        'season_id',
        'discipline_id',
        'category_id',
        'competition_type',
        'is_team_event',
    ];

    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id', 'season_id');
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'discipline_id', 'discipline_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}

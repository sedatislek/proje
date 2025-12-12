<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $table = 'clubs';
    protected $primaryKey = 'club_id';
    protected $fillable = ['club_name','province','is_active'];

    public function clubCompetitions()
    {
        return $this->hasMany(ClubCompetition::class, 'club_id', 'club_id');
    }

    public function delegates()
    {
        return $this->hasMany(Delegate::class, 'club_id', 'club_id');
    }

    public function nationalAthletes()
    {
        return $this->hasMany(NationalAthlete::class, 'club_id', 'club_id');
    }

    public function participations()
    {
        return $this->hasMany(\App\Models\ClubCompetition::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NationalAthlete extends Model
{
    use HasFactory;

    protected $table = 'national_athletes';
    protected $primaryKey = 'athlete_id';
    protected $fillable = ['club_id','discipline_id','category_id','achievement_level','achievement_year','gives_extra_delegate'];
}

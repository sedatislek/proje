<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $table = 'seasons';
    protected $primaryKey = 'season_id';
    protected $fillable = ['season_year','start_date','end_date'];

    public function competitions()
    {
        return $this->hasMany(Competition::class, 'season_id', 'season_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $table = 'disciplines';
    protected $primaryKey = 'discipline_id';
    protected $fillable = ['name','is_olympic'];

    public function competitions()
    {
        return $this->hasMany(Competition::class, 'discipline_id', 'discipline_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delegate extends Model
{
    use HasFactory;

    protected $table = 'delegates';
    protected $primaryKey = 'delegate_id';
    protected $fillable = ['club_id','season1','season2','delegate_type','category_id'];

    public function club()
    {
        return $this->belongsTo(\App\Models\Club::class, 'club_id', 'club_id');
    }
}

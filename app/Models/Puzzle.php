<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puzzle extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        ''
    ];

    public function cache()
    {
        return $this->belongsTo(Cache::class, 'cache_id');
    }

    public function getMobileCoordAttribute()
    {
        return [$this->posx, $this->posy];
    }
}

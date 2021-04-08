<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cache extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'num',
        'code',
        'type',
        'lat',
        'lon',
        'points',
        'nb_found',
        'found_at',
        'show_at',
        'bonus',
        'time_bonus',
        'enigme',
        'desc'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_caches')->withPivot('found_at');
    }

    public function puzzle()
    {
        return $this->hasOne(Puzzle::class, 'cache_id');
    }

    public function getCoordAttribute()
    {
        return [$this->lat, $this->lon];
    }

    public function getFoundAtAttribute()
    {
        if ($this->users)
        {
            return $this->users()->orderBy('users_caches.found_at', 'desc')->first()->pivot->found_at;
        }
        else
        {
            return null;
        }
    }

    public function getNbFoundAttribute()
    {
        $count = count($this->users);
        return  $count === 0 ? null : $count;
    }
}

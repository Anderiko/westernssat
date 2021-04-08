<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enigme extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'found',
        'throttle',
        'propositions'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

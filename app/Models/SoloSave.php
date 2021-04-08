<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoloSave extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'sceneIndex',
        'actionIndex',
        'started_at',
        'ended_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

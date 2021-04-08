<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupSave extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'party_id',
        'sceneIndex',
        'user_id',
        'actionIndex',
        'started_at',
        'ended_at',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Party extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'code',
        'user_id',
        'registered'
    ];

    public function members()
    {
        return $this->hasMany(User::class, 'party_id');
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groupSave()
    {
        return $this->hasOne(GroupSave::class, 'party_id');
    }
}

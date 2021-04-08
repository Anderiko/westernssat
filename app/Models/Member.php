<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'alias',
        'show_order',
        'photo_path',
        'bg_path',
        'description'
    ];

    public $timestamps = false;

    public function user ()
    {
        return $this->user_id !== null ? $this->belongsTo(User::class) : null;
    }
}

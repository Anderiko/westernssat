<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug',
        'name',
        'overview',
        'description',
        'start',
        'photo_path',
        'inscription_start',
        'max_participants',
        'price',
        'label_id'
    ];

    public $timestamps = false;

    public function label()
    {
        return $this->belongsTo(Label::class);
    }
}

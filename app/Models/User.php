<?php

namespace App\Models;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use App\Permissions\HasPermissionsTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, \Illuminate\Auth\MustVerifyEmail, HasPermissionsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'name',
        'faculty_id',
        'party_id',
        'email',
        'api_token',
        'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function getEmailAttribute($value)
    {
        return $value . env('MAIL_SUFFIX');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function party()
    {
        return $this->belongsTo(Party::class, 'party_id');
    }

    public function soloSave()
    {
        return $this->hasOne(SoloSave::class, 'user_id');
    }

    public function groupSave()
    {
        return $this->party->groupSave();
    }

    public function caches()
    {
        return $this->belongsToMany(Cache::class, 'users_caches')->withPivot('points_given');
    }

    public function enigme()
    {
        return $this->hasOne(Enigme::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'position',
        'division',
        'is_admin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function timeRecords()
    {
        return $this->hasMany(TimeRecord::class);
    }

    public function activeTimeRecord()
    {
        return $this->hasOne(TimeRecord::class)->whereNull('afternoon_time_out')->whereNotNull('morning_time_in');
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }
}

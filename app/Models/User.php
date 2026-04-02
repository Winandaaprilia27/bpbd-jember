<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'foto',
        'is_active',
        'last_login',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login' => 'datetime',
        'is_active' => 'boolean',
    ];

    // Cek role
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isKepala()
    {
        return $this->role === 'kepala';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    // Accessor untuk foto
    public function getFotoUrlAttribute()
    {
        if ($this->foto && file_exists(public_path('storage/users/' . $this->foto))) {
            return asset('storage/users/' . $this->foto);
        }
        return 'https://ui-avatars.com/api/?background=2c7da0&color=fff&size=100&name=' . urlencode($this->name);
    }
}
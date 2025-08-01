<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'data', // ← if you're using a JSON column in your DB
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'=> 'hashed',
            'data' => 'array',
        ];
    }

    // ✅ User has many addresses
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    // ✅ User has many tickets
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    // ✅ User has many payments
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // ✅ User has many roles (many-to-many)
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    // ✅ User can organize many events
    public function organizedEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }
}

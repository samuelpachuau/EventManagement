<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Panel;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'data', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'data' => 'array',
        ];
    }

    
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

   
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    
    public function organizedEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'organizer_id');
    }
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function bookedEvents(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'bookings');
    }

    public function canAccessPanel(Panel $panel): bool
    {
        // Only allow users where is_admin is 1
        return $this->is_admin === 1;
    }
}
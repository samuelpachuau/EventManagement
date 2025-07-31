<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'type',
        'description',
        'lat_long',
        'start_date',
        'end_date',
        'number_of_seats',
        'organizer_id',
        'image',
        'slug',
    ];

    
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}

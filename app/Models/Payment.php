<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'paid_amount',
        'paid_at',
        'status',
        'user_id',
        'reference',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}

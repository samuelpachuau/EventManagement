<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
    'ticket_type', // matches DB column
    'user_id',
    'event_id',
    'price',
    'code',
    
    'booking_id',
    ];

  
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }


    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    public function booking()
{
    return $this->belongsTo(Booking::class);
}

protected static function booted()
{
    static::creating(function ($ticket) {
        if (empty($ticket->code)) {
            $ticket->code = strtoupper(uniqid('TKT-')) . mt_rand(1000, 9999);
        }
    });
}

}

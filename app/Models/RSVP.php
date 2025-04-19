<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RSVP extends Model
{
    use HasFactory;

    protected $table = 'rsvps';

    protected $fillable = [
        'event_id',
        'guest_id',
        'status',
        'number_of_guests',
        'special_requests'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}

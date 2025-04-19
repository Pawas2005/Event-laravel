<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'notes',
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'rsvps')
            ->withPivot('status', 'number_of_guests', 'special_requests')
            ->withTimestamps();
    }

    public function rsvps()
    {
        return $this->hasMany(RSVP::class);
    }

    public function getAcceptedEventsCountAttribute()
    {
        return $this->events()->where('status', 'accepted')->count();
    }

    public function getDeclinedEventsCountAttribute()
    {
        return $this->events()->where('status', 'declined')->count();
    }

    public function getPendingEventsCountAttribute()
    {
        return $this->events()->where('status', 'pending')->count();
    }

    public function getMaybeEventsCountAttribute()
    {
        return $this->events()->where('status', 'maybe')->count();
    }
}

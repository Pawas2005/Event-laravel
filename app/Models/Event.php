<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'max_guests',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function guests()
    {
        return $this->belongsToMany(Guest::class, 'rsvps')
            ->withPivot('status', 'number_of_guests', 'special_requests')
            ->withTimestamps();
    }

    public function rsvps()
    {
        return $this->hasMany(RSVP::class);
    }

    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    public function getFormattedStartDateAttribute()
    {
        return $this->start_date->format('M d, Y');
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date->format('M d, Y');
    }
}

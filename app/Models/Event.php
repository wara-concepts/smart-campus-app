<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'organizer_id',
        'location',
        'event_date',
        'start_time',
        'end_time',
        'max_participants',
        'registration_deadline',
        'status'
    ];

    // Relationship with User (organizer)
    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    // Relationship with EventParticipant
    public function participants()
    {
        return $this->hasMany(EventParticipant::class);
    }
    
    // Get number of participants
    public function getParticipantCountAttribute()
    {
        return $this->participants()->count();
    }
    
    // Check if event is full
    public function isFullAttribute()
    {
        return $this->max_participants > 0 && $this->participant_count >= $this->max_participants;
    }
    
    // Check if registration deadline has passed
    public function isRegistrationClosedAttribute()
    {
        return Carbon::parse($this->registration_deadline)->isPast();
    }
    
    // Get event date formatted
    public function getEventDateFormattedAttribute()
    {
        return Carbon::parse($this->event_date)->format('F j, Y');
    }
    
    // Get formatted start and end time
    public function getTimeRangeAttribute()
    {
        return Carbon::parse($this->start_time)->format('h:i A') . ' - ' . 
               Carbon::parse($this->end_time)->format('h:i A');
    }
    
    // Check if user is registered for this event
    public function isUserRegistered($userId)
    {
        return $this->participants()->where('user_id', $userId)->exists();
    }
}
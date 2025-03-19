<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /** @use HasFactory<\Database\Factories\ResourceFactory> */
    use HasFactory;

    /** @var list<string> */
    public $fillable = ['id','department_id','name','qty','created_at','updated_at'];
    
    // Relationship with ResourceReservation
    public function reservations()
    {
        return $this->hasMany(ResourceReservation::class);
    }
    
    // Relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    // Get the available quantity for a specific date/time range
    public function getAvailableQuantity($startDateTime, $endDateTime)
    {
        // Get the total quantity of resources reserved for the given time range
        $reserved = $this->reservations()
            ->where('status', '!=', 'canceled')
            ->where(function($query) use ($startDateTime, $endDateTime) {
                $query->whereBetween('request_dateTime', [$startDateTime, $endDateTime])
                    ->orWhereBetween('handover_dateTime', [$startDateTime, $endDateTime])
                    ->orWhere(function($q) use ($startDateTime, $endDateTime) {
                        $q->where('request_dateTime', '<', $startDateTime)
                          ->where('handover_dateTime', '>', $endDateTime);
                    });
            })
            ->sum('qty');
            
        return $this->qty - $reserved;
    }
}
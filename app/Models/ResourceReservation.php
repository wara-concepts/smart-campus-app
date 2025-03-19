<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResourceReservation extends Model
{
    use HasFactory;

    protected $table = 'resource_reserve';
    
    protected $fillable = [
        'resource_id',
        'user_id',
        'request_dateTime',
        'handover_dateTime',
        'status',
        'qty',
        'purpose'
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Resource
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}
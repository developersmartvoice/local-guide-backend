<?php

namespace App\Models;

// use App\Models\Doctors;
use Illuminate\Database\Eloquent\Model;

class TripGuide extends Model
{
    protected $fillable = [
        'guide_id', 'destination', 'start_date', 'end_date', 'duration', 'people_quantity', 'type',
    ];

    // Set the primary key as 'id'
    protected $primaryKey = 'id';

    // Define the relationship with the guides table
    public function guide()
    {
        return $this->belongsTo(Doctors::class, 'guide_id', 'id');
    }
}

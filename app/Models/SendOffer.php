<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendOffer extends Model
{
    protected $table = 'send_offer';
    protected $fillable = [
        'trip_id', 'sender_id', 'recipient_id', 'date', 'duration', 'timing', 'message',
    ];

    // Set the primary key as 'id'
    protected $primaryKey = 'id';

    // Automatically manage timestamps
    public $timestamps = true;

    // Define the relationships with the trip_guides and doctors tables
    public function trip()
    {
        return $this->belongsTo(TripGuide::class, 'trip_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(Doctors::class, 'sender_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(Doctors::class, 'recipient_id', 'id');
    }
}

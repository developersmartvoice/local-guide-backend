<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DirectBooking extends Model
{
    protected $table = 'direct_booking';
    protected $fillable = [
        'sender_id',
        'recipient_id',
        'date',
        'duration',
        'timing',
        'message',
    ];

    // Set the primary key as 'id'
    protected $primaryKey = 'id';

    // Automatically manage timestamps
    public $timestamps = true;

    public function sender()
    {
        return $this->belongsTo(Doctors::class, 'sender_id', 'id');
    }

    public function recipient()
    {
        return $this->belongsTo(Doctors::class, 'recipient_id', 'id');
    }
}

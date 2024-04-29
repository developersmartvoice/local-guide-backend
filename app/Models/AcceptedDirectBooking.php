<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcceptedDirectBooking extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'accepted';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'direct_booking_id',
        'sender_id',
        'recipient_id',
        'date',
        'duration',
        'timing',
        'message',
        'num_people',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;
}

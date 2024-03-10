<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MembershipDetail extends Model
{
    protected $fillable = [
        'guide_id',
        'month',
        'ending_subscription',
        'amount'
    ];

    // Define relationships
    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'guide_id', 'id');
    }
}

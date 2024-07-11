<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralInfo extends Model
{
    protected $table = 'referral_info';

    protected $fillable = [
        'referred_id',
        'new_register_id',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'referred_id');
    }

    public function newRegister()
    {
        return $this->belongsTo(Doctors::class, 'new_register_id');
    }
}

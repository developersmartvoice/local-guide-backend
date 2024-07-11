<?php
namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    // use HasFactory;

    protected $table = 'withdrawals';

    protected $fillable = [
        'referred_id',
        'amount',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(Doctors::class, 'referred_id', 'id');
    }
}

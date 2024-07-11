<?php
namespace App\Models;

// <!-- use Illuminate\Database\Eloquent\Factories\HasFactory; -->
use Illuminate\Database\Eloquent\Model;

class ReferredUserEarnings extends Model
{
    // use HasFactory;

    protected $table = 'referred_user_earnings';

    protected $fillable = [
        'referred_id',
        'new_id',
        'amount',
        'currency',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(Doctors::class, 'referred_id', 'id');
    }
}

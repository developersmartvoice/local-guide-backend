<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderIdInfo extends Model
{
    // use HasFactory;

    protected $table = 'order_id_info';

    protected $fillable = ['guide_id', 'order_id'];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class, 'guide_id');
    }
}

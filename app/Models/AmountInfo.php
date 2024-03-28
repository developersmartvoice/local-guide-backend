<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AmountInfo extends Model
{
    protected $table = 'amount_info';

    protected $primaryKey = 'id';
    protected $fillable = [
        'month',
        'amount',
        'currency',
    ];

    
}

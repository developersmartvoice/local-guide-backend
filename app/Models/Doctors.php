<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctors extends Model
{
    protected $table = 'doctors';
    protected $primaryKey = 'id';
    // protected $fillable = ['motto']; // Add 'motto' to the $fillable array

    public function departmentls()
    {
        return $this->hasOne("App\Models\Services", 'id', 'department_id');
    }

    public function reviewls()
    {
        return $this->hasMany("App\Models\Review", 'doc_id', 'id');
    }

    public function tripGuides()
    {
        return $this->hasMany(TripGuide::class, 'guide_id', 'id');
    }
    public function orderInfos()
    {
        return $this->hasMany(OrderIdInfo::class, 'guide_id', 'id');
    }
}
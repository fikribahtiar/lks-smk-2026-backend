<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'society_id',
        'car_id',
        'months',
        'notes'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

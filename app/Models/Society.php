<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Society extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name',
        'id_card_number',
        'password',
        'born_date',
        'gender',
        'address',
        'regional_id'
    ];

    protected $hidden = [
        'password',
    ];

    public function regional()
    {
        return $this->belongsTo(Regional::class);
    }

    public function validation()
    {
        return $this->hasOne(Validation::class);
    }

    public function applications()
    {
        return $this->hasMany(\App\Models\Application::class);
    }
}


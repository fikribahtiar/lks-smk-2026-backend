<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = [
        'society_id',
        'job',
        'job_description',
        'income',
        'reason_accepted',
        'status'
    ];

    public function society()
    {
        return $this->belongsTo(Society::class);
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validator_id');
    }
}

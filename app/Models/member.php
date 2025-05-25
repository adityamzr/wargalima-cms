<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    protected $fillable = [
        'family_id', 'nik', 'name', 'birth_place', 'birth_date', 'phone', 'domicile',
        'avatar', 'family_status', 'mariage_status', 'job_status'
    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'submitter', 'phone', 'type', 'date', 'location', 'description', 'file_path'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'submitter');
    }
}

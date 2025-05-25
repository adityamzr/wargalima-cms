<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class family extends Model
{
    protected $fillable = [
        'zone', 'code', 'name', 'amount', 'address', 'joinDate', 'image'
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'zone', 'column', 'name', 'members_amount', 'address', 'joinDate', 'image'
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'name'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}

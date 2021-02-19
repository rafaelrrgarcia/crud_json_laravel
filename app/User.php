<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'address_id',
        'name'
    ];

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}

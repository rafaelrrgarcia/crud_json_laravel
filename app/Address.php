<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'city_id',
        'address'
    ];

    protected $hidden = [
        'addresses'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

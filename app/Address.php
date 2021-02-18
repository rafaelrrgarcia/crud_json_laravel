<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'city_id',
        'address'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}

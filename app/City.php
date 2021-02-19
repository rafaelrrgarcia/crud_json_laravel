<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'state_id',
        'name'
    ];

    protected $appends = [
        'users_count'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function getUsersCountAttribute()
    {
        // Count the users
        $userCount = 0;
        $addresses = $this->addresses;
        if ($addresses) {
            for ($i = 0; $i < count($addresses); $i++) {
                $userCount += $addresses[$i]->users->count();
            }
        }
        unset($this->addresses);
        return $userCount;
    }
}

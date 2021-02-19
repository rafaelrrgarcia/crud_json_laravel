<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = [
        'name',
        'uf'
    ];

    protected $appends = [
        'users_count'
    ];

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function getUsersCountAttribute()
    {
        // Count the users
        $userCount = 0;
        $cities = $this->cities;
        if ($cities) {
            for ($i = 0; $i < count($cities); $i++) {
                $addresses = $cities[$i]->addresses;
                if ($addresses) {
                    for ($j = 0; $j < count($addresses); $j++) {
                        $userCount += $addresses[$j]->users->count();
                    }
                }
            }
        }
        unset($this->cities);
        return $userCount;
    }
}

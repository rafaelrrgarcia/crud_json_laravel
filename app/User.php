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

    public static function createFull($request)
    {
        try {
            // Check blank fields
            if (!$request->name) throw new \Exception("Name not defined");
            if (!$request->address) throw new \Exception("Address not defined");
            if (!$request->city) throw new \Exception("City not defined");
            if (!$request->state) throw new \Exception("State not defined");
            if (!$request->state_uf) throw new \Exception("UF not defined");

            // Get a State or register a new State
            $state = State::query()->where("uf", $request->state_uf)->first();
            if (!$state) {
                $newStateFields = [
                    'name' => $request->state,
                    'uf' => $request->state_uf
                ];
                $state = State::create($newStateFields);
                if (!$state) throw new \Exception("It was not possible to register a new State");
            }

            // Get a City or register a new City
            $city = City::query()->where("name", $request->city)->where("state_id", $state->id)->first();
            if (!$city) {
                $newCityFields = [
                    'state_id' => $state->id,
                    'name' => $request->city
                ];
                $city = City::create($newCityFields);
                if (!$city) throw new \Exception("It was not possible to register a new City");
            }

            // Get an Address or register a new Address
            $address = Address::query()->where("address", $request->address)->where("city_id", $city->id)->first();
            if (!$address) {
                $newAddressFields = [
                    'city_id' => $city->id,
                    'address' => $request->address
                ];
                $address = Address::create($newAddressFields);
                if (!$address) throw new \Exception("It was not possible to register a new Address");
            }

            // Register user
            $newUserFields = [
                'address_id' => $address->id,
                'name' => $request->name
            ];
            $user = User::create($newUserFields);
            return $user->toArray();

        } catch (\Exception $e) {
            return $e;
        }
    }
}

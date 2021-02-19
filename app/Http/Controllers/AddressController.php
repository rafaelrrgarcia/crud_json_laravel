<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::query()
            ->orderBy('address')
            ->get();
        return $addresses->toJson();
    }

    public function create(Request $request)
    {
        $newAddress = Address::create($request->all());
        return $newAddress->toJson();
    }

    public function read(Request $request)
    {
        try {
            $address = Address::find($request->id);
            if ($address == null) {
                throw new \Exception('Address not found.');
            }
            return $address->toJson();
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $address = Address::find($request->id);
            if ($address != null) {
                $address->city_id = $request->city_id;
                $address->address = $request->address;
                $address->save();
            } else {
                throw new \Exception('Address not found.');
            }
            return json_encode(['success' => false, 'message' => 'Address successfully updated']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $address = Address::find($request->id);
            if ($address != null) {
                Address::destroy($request->id);
            } else {
                throw new \Exception('Address not found.');
            }
            return json_encode(['success' => false, 'message' => 'Address successfully deleted']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

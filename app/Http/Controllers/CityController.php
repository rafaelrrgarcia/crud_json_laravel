<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::query()
            ->orderBy('name')
            ->get();
        return $cities->toJson();
    }

    public function create(Request $request)
    {
        $newCity = City::create($request->all());
        return $newCity->toJson();
    }

    public function read(Request $request)
    {
        try {
            $city = City::find($request->id);
            if ($city == null) {
                throw new \Exception('City not found.');
            }
            return $city->toJson();
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $city = City::find($request->id);
            if ($city != null) {
                $city->state_id = $request->state_id;
                $city->name = $request->name;
                $city->save();
            } else {
                throw new \Exception('City not found.');
            }
            return json_encode(['success' => false, 'message' => 'City successfully updated']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $city = City::find($request->id);
            if ($city != null) {
                City::destroy($request->id);
            } else {
                throw new \Exception('City not found.');
            }
            return json_encode(['success' => false, 'message' => 'City successfully deleted']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

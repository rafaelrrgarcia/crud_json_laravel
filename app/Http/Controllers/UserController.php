<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->orderBy('name')
            ->get();
        return $users->toJson();
    }

    public function create(Request $request)
    {
        $newUser = User::create($request->all());
        return $newUser->toJson();
    }

    public function createFull(Request $request)
    {
        try {
            // Check blank fields
            if (!$request->name) throw new \Exception("Name not defined");
            if (!$request->address) throw new \Exception("Address not defined");
            if (!$request->city) throw new \Exception("City not defined");
            if (!$request->state) throw new \Exception("State not defined");
            if (!$request->state_uf) throw new \Exception("UF not defined");

            $newUser = User::createFull($request); // Try to register a new user with full requirements. Array returned.
            if($newUser instanceof \Exception){ // If throws an error
                throw $newUser;
            } else {
                return json_encode($newUser);
            }
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function read(Request $request)
    {
        try {
            $user = User::find($request->id);
            if ($user == null) {
                throw new \Exception('User not found.');
            }
            return $user->toJson();
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::find($request->id);
            if ($user != null) {
                $user->address_id = $request->address_id;
                $user->name = $request->name;
                $user->save();
            } else {
                throw new \Exception('User not found.');
            }
            return json_encode(['success' => false, 'message' => 'User successfully updated']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $user = User::find($request->id);
            if ($user != null) {
                User::destroy($request->id);
            } else {
                throw new \Exception('User not found.');
            }
            return json_encode(['success' => false, 'message' => 'User successfully deleted']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

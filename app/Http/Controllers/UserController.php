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

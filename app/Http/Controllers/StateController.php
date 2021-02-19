<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index()
    {
        $states = State::query()
            ->orderBy('name')
            ->get();
        return $states->toJson();
    }

    public function create(Request $request)
    {
        $newState = State::create($request->all());
        return $newState->toJson();
    }

    public function read(Request $request)
    {
        try {
            $state = State::find($request->id);
            if ($state == null) {
                throw new \Exception('State not found.');
            }
            return $state->toJson();
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        try {
            $state = State::find($request->id);
            if ($state != null) {
                $state->name = $request->name;
                $state->uf = $request->uf;
                $state->save();
            } else {
                throw new \Exception('State not found.');
            }
            return json_encode(['success' => true, 'message' => 'State successfully updated']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete(Request $request)
    {
        try {
            $state = State::find($request->id);
            if ($state != null) {
                State::destroy($request->id);
            } else {
                throw new \Exception('State not found.');
            }
            return json_encode(['success' => true, 'message' => 'State successfully deleted']);
        } catch (\Exception $e) {
            return json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}

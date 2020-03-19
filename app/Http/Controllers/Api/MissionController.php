<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mission;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    public function index()
    {
        $missions = Mission::orderBy('year')->get();

        return $missions;
    }

    public function changeMission(Request $request)
    {
        $mission = Mission::findOrFail($request->input('mission'));
        $person = $request->input('person_id');

        if ($mission->people()->find($person) === null) {
            $mission->people()->attach($person);
        } else {
            $mission->people()->detach($person);
        }

        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Person;
use Croppa;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::with('image')
            ->orderBy('name', 'asc')
            ->limit(20)
            ->get();

        foreach ($people as $person) {
            $person->image_url = Croppa::url('images/' . $person->image->path, 80, null, ['resize']);
        }

        return $people;
    }

    public function changeStatus(Request $request)
    {
        $p = Person::findOrFail($request->input('person_id'));
        // this 'status' below comes from the handlerSubmit thing:" status: this.state.status"
        $p->status_id = $request->input('status');
        $p->save();
    }
}

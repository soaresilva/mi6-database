<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Person;

class PersonController extends Controller
{
    public function index()
    {
        $people = Person::orderBy('name', 'asc')
            ->limit(20)
            ->get();
        return $people;
    }
}

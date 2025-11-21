<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    public function index() {
        $petitions = Petition::all();
        return view('petitions.index', compact('petitions'));
    }

    public function show(Petition $petition) {
        return view('petitions.index', compact('petition'));
    }
}

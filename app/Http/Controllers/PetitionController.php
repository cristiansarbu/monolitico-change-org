<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class PetitionController extends Controller
{
    public function index() {
        $petitions = Petition::all();
        return response()->json(['data' => $petitions], 200);
    }

    public function show(Petition $petition) {
        return response()->json(['data' => $petition], 200);
    }
}

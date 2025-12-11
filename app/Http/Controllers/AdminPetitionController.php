<?php

namespace App\Http\Controllers;

use App\Models\Petition;
use Illuminate\Http\Request;

class AdminPetitionController extends Controller
{
    public function index() {
        $petitions = Petition::all();
        return view('admin.home', compact('petitions'));
    }

    public function show($id) {
        $petition = Petition::firstOrFail($id);
        return view('admin.petitions.show', compact($petition));
    }
}

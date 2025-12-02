<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoyagerUsersController extends Controller
{
    public function signedPetitions(Request $request) {
        try {
            $id = Auth::id();
            $user = User::findOrFail($id);
            $petitions = $user->signedPetitions()->paginate(4);
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return view('petitions.signedpetitions', compact('petitions'));
    }
}

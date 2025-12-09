<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPetitionController extends Controller
{
    public function index() {
        return view('admin.home');
    }
}

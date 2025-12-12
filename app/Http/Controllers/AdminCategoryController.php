<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('admin.petitions.edit', compact('petition', 'categories'));
    }
}

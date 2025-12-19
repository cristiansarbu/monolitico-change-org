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
        return view('admin.categories.edit', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $input = $request->all();

        try {
            $category = new Category($input);
            $category->save();
            return redirect('admin/categories/index')->with('success', 'Categoria creada correctamente.');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        try {
            $category->name = $request->name;
            $category->save();
            return redirect('admin/categories/index')->with('success', 'Categoria actualizada correctamente.');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function delete($id) {
        try {
            $category = Category::findOrFail($id);

            if ($category->petitions->count() > 0) {
                return back()->withError('No se puede eliminar una categoría que tiene peticiones activas.');
            }

            $category->delete();
            return redirect('admin/categories/index')->with('success', 'Categoria eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
}

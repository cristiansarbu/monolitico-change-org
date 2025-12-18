<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPetitionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Petition::class, 'petition');
    }
    public function index() {
        $petitions = Petition::all();
        return view('admin.home', compact('petitions'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.petitions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required',
            'file' => 'required|file|mimes:jpeg,png,jpg,svg'
        ]);

        $input = $request->all();

        try {
            $category = Category::findOrFail($input['category_id']);
            $user = Auth::user();
            $petition = new Petition($input);
            $petition->category()->associate($category);
            $petition->user()->associate($user);

            $petition->signers = 0;
            $petition->status = 'pending';

            $res = $petition->save();

            if ($res) {
                $res_file = $this->fileUpload($request, $petition->id);
                if ($res_file) {
                    return redirect('admin');
                } else {
                    return back()->withError('Error creando la petition')->withInput();
                }
            }
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function show($id) {
        $petition = Petition::findOrFail($id);
        $user = $petition->user;
        return view('admin.petitions.show', compact('petition', 'user'));
    }

    public function edit($id) {
        $petition = Petition::findOrFail($id);
        $categories = Category::all();
        return view('admin.petitions.edit', compact('petition', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'destinatary' => 'required',
            'category_id' => 'required',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,svg'
        ]);

        $input = $request->except('file');

        try {
            $petition->update($input);

            if ($request->hasFile('file')) {
                $fileExistente = File::where('petition_id', $id)->first();
                $fileExistentePath = public_path('petitions/' . $fileExistente->file_path);
                unlink($fileExistentePath);
                $fileExistente->delete();

                $this->fileUpload($request, $petition->id);
            }
            return redirect('admin')->with('success', 'Petición actualizada correctamente.');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function fileUpload(Request $req, $petition_id = null)
    {
        $file = $req->file('file');

        $fileModel = File::where('petition_id', $petition_id)->first();
        if (!$fileModel) {
            $fileModel = new File;
            $fileModel->petition_id = $petition_id;
            if ($req->file('file')) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move('petitions', $filename);
                $fileModel->name = $filename;
                $fileModel->file_path = $filename;

                $res = $fileModel->save();
                return $fileModel;
            }
            return 1;
        }
    }

    public function delete($id) {
        try {
            $petition = Petition::findOrFail($id);

            if ($petition->signers > 0) {
                return back()->withError('No se puede eliminar una petición que ha sido firmada.');
            }

            $file = File::where('petition_id', $id)->first();

            if ($file) {
                $filePath = public_path('petitions/' . $file->file_path);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $file->delete();
            }

            $petition->signers()->detach();
            $petition->delete();

            return redirect('admin')->with('success', 'Petición eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function changeStatus($id) {
        $petition = Petition::findOrFail($id);
        if ($petition->status == 'pending') {
            $petition->status = 'accepted';
        } else {
            $petition->status = 'pending';
        }
        $petition->save();

        $petitions = Petition::all();

        return redirect('admin');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    public function index()
    {
        $petitions = Petition::paginate(4);
        $categories = Category::all();
        return view('petitions.index', compact('petitions', 'categories'));
    }

    public function show(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);
        $user = $petition->user;
        if ($user == Auth::user()) {
            return view('petitions.showmine', compact('petition', 'user'));
        }
        return view('petitions.show', compact('petition', 'user'));
    }

    public function listCategory($category) {
        $category = Category::findOrFail($category);
        $petitions = $category->petitions;
        $categories = Category::all();
        return view('petitions.index', compact('petitions', 'categories'));
    }

    public function getUpdatePage($id) {
        $petition = Petition::findOrFail($id);
        $categories = Category::all();
        return view('petitions.update', compact('petition', 'categories'));
    }

    public function listMine(Request $request)
    {
        try {
            $user = Auth::user();
            // Esto se podría reemplazar por $user->petitions
            $petitions = Petition::where('user_id', $user->id)->paginate(4);
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return view('petitions.mypetitions', compact('petitions'));
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
                    return redirect('/mypetitions');
                } else {
                    return back()->withError('Error creando la petition')->withInput();
                }
            }
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

    public function update(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);

        if ($petition->user_id !== Auth::id()) {
            return back()->withError('No tienes permiso para editar esta petición.');
        }

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

            return redirect('/mypetitions')->with('success', 'Petición actualizada correctamente.');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function delete($id) {
        try {
            $petition = Petition::findOrFail($id);

            if ($petition->user_id !== Auth::id()) {
                return back()->withError('No tienes permiso para eliminar esta petición.');
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

            return redirect('/mypetitions')->with('success', 'Petición eliminada correctamente.');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }

    public function create()
    {
        $categories = Category::all();
        return view('petitions.create', compact('categories'));
    }

    public function sign(Request $request, $id) {
        try {
            $petition = Petition::findOrFail($id);
            $user = Auth::user();
            $signers = $petition->signers()->get();
            foreach ($signers as $signer) {
                if ($signer->id == $user->id) {
                    return back()->withError('Ya has firmado esta petición.')->withInput();
                }
            }
            $user_id = [$user->id];
            $petition->signers()->attach($user_id);
            $petition->signers = $petition->signers + 1;
            $petition->save();
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
        return redirect()->back();
    }

    public function signedPetitions(Request $request) {
        $id = Auth::id();
        $user = User::findOrFail($id);
        $petitions = $user->signedPetitions()->paginate(4);
        return view('petitions.signedpetitions', compact('petitions'));
    }

}

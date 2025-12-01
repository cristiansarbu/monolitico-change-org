<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\File;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetitionController extends Controller
{
    public function index()
    {
        $petitions = Petition::paginate(5);
        return view('petitions.index', compact('petitions'));
    }

    public function show(Request $request, $id)
    {
        $petition = Petition::findOrFail($id);
        $user = $petition->user;
        return view('petitions.show', compact('petition', 'user'));
    }

    public function listMine(Request $request)
    {
        try {
            $user = Auth::user();
            $petitions = Petition::where('user_id', $user->id)->paginate(5);
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
            'category' => 'required',
            'file' => 'required|file|mimes:jpeg,png,jpg,svg'
        ]);

        $input = $request->all();


        try {
            $category = Category::find($input['category'])->firstOrFail();
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

}

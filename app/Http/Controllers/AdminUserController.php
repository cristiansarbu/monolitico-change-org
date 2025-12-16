<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function show($id) {;
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);
        $datosValidados = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'nullable|string|min:8|max:255',
            'admin' => 'nullable|boolean',
        ]);

        try {
            if (isset($datosValidados['password'])) {
                $user->password = Hash::make($datosValidados['password']);
            }

            $user->name = $datosValidados['name'];
            $user->email = $datosValidados['email'];

            if (isset($datosValidados['admin'])) {
                $user->admin = $datosValidados['admin'];
            } else {
                $user->admin = 0;
            }

            $user->save();
            return redirect('admin/users/index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
    }

    public function delete($id) {
        try {
            $user = User::findOrFail($id);

            if ($user->signedPetitions->count() > 0) {
                return back()->withError('No se puede eliminar un usuario que ha firmado peticiones.');
            }

            if ($user->petitions->count() > 0) {
                return back()->withError('No se puede eliminar un usuario que tiene peticiones.');
            }

            $user->delete();

            return redirect('admin')->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return back()->withError($e->getMessage())->withInput();
        }
    }
}

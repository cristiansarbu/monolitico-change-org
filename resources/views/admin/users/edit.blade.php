@extends('layouts.admin')

@section('title')
    <title>Editar usuario - Change.org</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('content')
    <div class="d-flex flex-column align-items-center min-vh-100 py-5" style="background-color: #f8f9fa;">
        <div class="card shadow-sm rounded-4" style="width: 100%; max-width: 420px;">
            <div class="card-body p-4 p-md-5">

                <h3>Editar usuario</h3>

                <form method="POST" action="{{ route('adminusers.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="form-label text-muted">Nombre</label>
                        <input id="name"
                               type="text"
                               name="name"
                               class="form-control form-control-lg @error('name') is-invalid @enderror"
                               value="{{ old('name', $user->name) }}"
                               required autofocus autocomplete="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label text-muted">Correo Electrónico</label>
                        <input id="email"
                               type="email"
                               name="email"
                               class="form-control form-control-lg @error('email') is-invalid @enderror"
                               value="{{ old('email', $user->email) }}"
                               required autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label text-muted">Nueva Contraseña (opcional)</label>
                        <input id="password"
                               type="password"
                               name="password"
                               class="form-control form-control-lg @error('password') is-invalid @enderror"
                               value="{{ old('password') }}"
                               autocomplete="new-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input id="admin"
                                   type="checkbox"
                                   name="admin"
                                   class="form-check-input @error('admin') is-invalid @enderror"
                                   value="1"
                                {{ old('admin', $user->admin) ? 'checked' : '' }}>
                            <label for="admin" class="form-check-label text-muted fw-bold">Es Administrador (opcional)</label>
                        </div>
                        <x-input-error :messages="$errors->get('admin')" class="mt-2" />
                    </div>

                    <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('adminusers.index') }}" class="btn btn-outline-secondary fw-bold px-4 py-2">
                            Volver
                        </a>
                        <button type="submit" class="btn btn-dark text-uppercase px-4 py-2">
                            Editar
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

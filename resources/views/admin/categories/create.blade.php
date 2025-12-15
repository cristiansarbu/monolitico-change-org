@extends('layouts.admin')

@section('title')
    <title>Crear categoría - Change.org</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create-petition.css') }}">
@endsection

@section('content')
    <main class="container d-flex justify-content-center mt-3">
        <div class="p-4 p-md-5 contenedor-todo">

            <h1 class="fw-bold fs-3 mb-2 fs-2rem">Crear la categoría</h1>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <strong>Error:</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admincategories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="mb-4">
                    <label for="name" class="form-label fw-bold">Nombre de la categoría</label>
                    <input type="text" id="name" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Ejemplo: Sanidad Pública"
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('admincategories.index') }}" class="btn btn-outline-secondary fw-bold px-4 py-2">
                        Volver
                    </a>
                    <button type="submit" class="button-create-petition px-4 py-2 fw-bold">
                        Crear categoría
                    </button>
                </div>
            </form>
        </div>
    </main>
@endsection

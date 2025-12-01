@extends('layouts.public')

@section('title')
    <title>Crear petición - Change.org</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/create-petition.css') }}">
@endsection

@section('content')
    <main class="container d-flex justify-content-center mt-3">
        <div class="p-4 p-md-5 contenedor-todo">

            <h1 class="fw-bold fs-3 mb-2 fs-2rem">Crear una nueva petición</h1>
            <p class="text-body mb-4 fs-1125rem">
                Completa la información siguiente para que podamos ayudarte a generar una petición clara, sólida e impactante.
            </p>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                    <strong>Error:</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- FORMULARIO --}}
            <form action="{{ route('petitions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- TÍTULO --}}
                <div class="mb-4">
                    <label for="title" class="form-label fw-bold">Título de la petición *</label>
                    <input type="text" id="title" name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           placeholder="Ejemplo: Queremos que el gobierno mejore la atención sanitaria."
                           value="{{ old('title') }}">
                    <small class="text-muted">Debe ser breve, claro y directo. Máximo 255 caracteres.</small>
                    @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESCRIPCIÓN --}}
                <div class="mb-4">
                    <label for="description" class="form-label fw-bold">Descripción detallada *</label>
                    <textarea id="description" name="description" rows="5"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Explica claramente por qué esta petición es importante y qué cambio deseas lograr.">{{ old('description') }}</textarea>
                    @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- DESTINATARIO --}}
                <div class="mb-4">
                    <label for="destinatary" class="form-label fw-bold">¿A quién va dirigida la petición? *</label>
                    <input type="text" id="destinatary" name="destinatary"
                           class="form-control @error('destinatary') is-invalid @enderror"
                           placeholder="Ejemplo: Ministro de Educación, Ayuntamiento de Madrid, etc."
                           value="{{ old('destinatary') }}">
                    <small class="text-muted">Indica la persona, institución u organización que puede realizar el cambio.</small>
                    @error('destinatary')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- CATEGORÍA --}}
                <div class="mb-4">
                    <label for="category" class="form-label fw-bold">Categoría de la petición *</label>
                    {{-- Reemplazamos el input por un select --}}
                    <select id="category" name="category"
                            class="form-select @error('category') is-invalid @enderror">

                        <option value="">Selecciona una categoría</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    <small class="text-muted">Elige una categoría que describa tu petición.</small>
                    @error('category')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


                {{-- ARCHIVO / IMAGEN --}}
                <div class="mb-4">
                    <label for="file" class="form-label fw-bold">Imagen o archivo relacionado *</label>
                    <input type="file" id="file" name="file"
                           class="form-control @error('file') is-invalid @enderror"
                           accept=".jpg,.jpeg,.png,.svg">
                    <small class="text-muted">Formatos permitidos: JPG, JPEG, PNG, SVG.</small>
                    @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BOTONES --}}
                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary fw-bold px-4 py-2">
                        Volver
                    </a>
                    <button type="submit" class="button-create-petition px-4 py-2 fw-bold">
                        Crear petición
                    </button>
                </div>

            </form>
        </div>
    </main>
@endsection

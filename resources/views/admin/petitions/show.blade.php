@extends('layouts.admin')

@section('title')
    <title>Petition - Change.org</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/petition.css') }}">
@endsection

@section('content')
    <main class="container mt-5">
        <div class="row">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-12 col-lg-8">

                <h1 class="fw-bold fs-1 text-center text-lg-start">{{ $petition->title }}</h1>

                <div class="mt-4 mb-5">
                    <img src="{{ asset('petitions/' . $petition->files[0]->file_path) }}" class="img-fluid">
                </div>

                <div class="border-top pt-3">
                    <h2 class="mb-4 fs-2rem fw-bold">El problema</h2>
                    <p class="texto-peticion">{{ $petition->description }}</p>
                    <hr>
                    <div class="d-flex align-items-center justify-content-between pt-3 mb-5">
                        <div class="d-flex align-items-center">
                            <div class="bg-light-subtle rounded-circle d-flex justify-content-center align-items-center me-3"
                                 style="width: 50px; height: 50px;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#808080"
                                     class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                </svg>
                            </div>

                            <div class="d-flex flex-column">
                                <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                                <small class="text-muted">Creador de la petición</small>
                            </div>
                        </div>

                        <button type="button" class="btn btn-outline-secondary fw-bold py-2 px-3">
                            Consultas de medios de comunicación
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

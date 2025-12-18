@extends('layouts.admin')

@section('title')
    <title>Admin Dashboard - Change.org</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin-home.css') }}">
@endsection

@section('content')
    <div class="container-fluid p-4">

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex mb-3 align-items-center">
            <a href="{{ route('adminpetitions.create') }}"
               class="btn btn-primary me-3 text-white">
                Crear petición
            </a>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="bg-light">
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Firmantes</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($petitions as $petition)
                            <tr>
                                <td>{{ $petition->id }}</td>
                                <td class="petition-title">{{ $petition->title }}</td>
                                <td class="petition-description">{{ $petition->description }}</td>
                                <td class="petition-category">{{ $petition->category->name }}</td>
                                <td>{{ $petition->signers }}</td>
                                @if($petition->status == 'accepted')
                                    <td><span class="badge bg-success text-white">Aceptada</span></td>
                                @else
                                    <td><span class="badge bg-warning text-dark">Pendiente</span></td>
                                @endif
                                <td>
                                    <a href="{{ route('adminpetitions.show', $petition->id) }}"
                                       class="table-action-btn rounded-pill bg-secondary text-white text-decoration-none me-2 px-3 py-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-eye" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                            <path
                                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('adminpetitions.status', $petition->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        @if($petition->status == 'pending')
                                            <button type="submit"
                                                    class="table-action-btn rounded-pill bg-success text-white text-decoration-none me-2 px-3 py-1 border-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                     class="bi bi-check" viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                                </svg>
                                            </button>
                                        @else
                                            <button type="submit"
                                                    class="table-action-btn rounded-pill bg-warning text-white text-decoration-none me-2 px-3 py-1 border-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8"/>
                                                </svg>
                                            </button>
                                        @endif
                                    </form>
                                    <a href="{{ route('adminpetitions.edit', $petition) }}"
                                       class="table-action-btn rounded-pill text-white text-decoration-none me-2 px-3 py-1"
                                       style="background-color: #9c27b0;">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path
                                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd"
                                                  d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                        </svg>
                                    </a>
                                    <button type="button"
                                            class="table-action-btn rounded-pill bg-danger text-white text-decoration-none px-3 py-1 border-0"
                                            data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal{{ $petition->id }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                             class="bi bi-trash" viewBox="0 0 16 16">
                                            <path
                                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path
                                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </button>
                                    <div class="modal fade" id="confirmDeleteModal{{ $petition->id }}" tabindex="-1"
                                         aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title fw-bold">¿Seguro que quieres eliminar esta
                                                        petición?</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body text-center">
                                                    Esta acción no se puede deshacer. Se eliminará la petición
                                                    permanentemente.
                                                </div>

                                                <div class="modal-footer d-flex justify-content-between">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancelar
                                                    </button>

                                                    <form
                                                        action="{{ route('adminpetitions.delete', $petition->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="btn btn-danger fw-bold">Eliminar definitivamente
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if($petitions instanceof \Illuminate\Pagination\LengthAwarePaginator)
            @if ($petitions->hasPages())
                <div class="d-flex justify-content-center mb-5 mt-4">
                    {{ $petitions->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection

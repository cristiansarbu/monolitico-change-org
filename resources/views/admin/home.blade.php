@php
    use Illuminate\Support\Facades\Auth;
@endphp

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
    <div class="d-flex">

        <div class="sidebar d-flex flex-column p-0 text-white position-fixed">

            <div class="p-3 text-center border-bottom border-light border-opacity-25" style="height: 57px;">
                <span class="fs-4 fw-bold">Panel de Admin</span>
            </div>

            <div class="p-3 text-center mb-4">
                <div class="d-flex flex-column align-items-center">
                    <img src="{{ asset('img/admin/icono-usuario.png') }}" style="width: 90px" alt="Admin Avatar"
                         class="rounded-circle border-white">
                    <span class="fw-semibold">Admin</span>
                </div>
            </div>

            <div class="p-3 pt-0">
                <p class="text-uppercase fw-bold opacity-75 mb-2 small">Menú Principal</p>
                <ul class="list-group list-group-flush"
                    style="--bs-list-group-bg: transparent; --bs-list-group-border-color: transparent;">

                    <li class="list-group-item text-white py-2">
                        <i class="bi bi-circle-fill me-2 small"></i> Peticiones
                    </li>

                    <li class="list-group-item text-white py-2">
                        <i class="bi bi-circle-fill me-2 small"></i> Categorías
                    </li>

                    <li class="list-group-item text-white py-2">
                        <i class="bi bi-circle-fill me-2 small"></i> Usuarios
                    </li>
                </ul>
            </div>
        </div>

        <div class="main-content flex-grow-1">
            <div class="container-fluid p-4">

                <div class="d-flex mb-3 align-items-center">
                    <button class="btn btn-primary me-3 text-white">Crear petición</button>
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
                                    <th scope="col">Firmantes</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($petitions as $petition)
                                    <tr>
                                        <td>{{ $petition->id }}</td>
                                        <td>{{ $petition->title }}</td>
                                        <td class="petition-description">{{ $petition->description }}</td>
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
                                            <a href=""
                                               class="table-action-btn rounded-pill bg-success text-white text-decoration-none me-2 px-3 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                     class="bi bi-check" viewBox="0 0 16 16">
                                                    <path
                                                        d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                                                </svg>
                                            </a>
                                            <a href="#"
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
                                            <a href="#"
                                               class="table-action-btn rounded-pill bg-danger text-white text-decoration-none px-3 py-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                     class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                                    <path
                                                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                                </svg>
                                            </a>
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
                        <div class="d-flex justify-content-center mb-5">
                            {{ $petitions->links() }}
                        </div>
                    @endif
                @endif

            </div>

        </div>
    </div>
@endsection

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
                        <img src="{{ asset('img/admin/icono-usuario.png') }}" style="width: 90px" alt="Admin Avatar" class="rounded-circle border-white">
                        <span class="fw-semibold">Admin</span>
                    </div>
                </div>

                <div class="p-3 pt-0">
                    <p class="text-uppercase fw-bold opacity-75 mb-2 small">Menú Principal</p>
                    <ul class="list-group list-group-flush" style="--bs-list-group-bg: transparent; --bs-list-group-border-color: transparent;">

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
                                                <a href="#" class="rounded-pill bg-success text-white text-decoration-none px-3 py-1">Aceptar</a>
                                                <a href="#" class="rounded-pill text-white text-decoration-none px-3 py-1" style="background-color: #9c27b0;">Modificar</a>
                                                <a href="#" class="rounded-pill bg-danger text-white text-decoration-none px-3 py-1">Borrar</a>
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

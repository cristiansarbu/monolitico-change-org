@extends('layouts.admin')

@section('title')
    <title>Detalles de Usuario: {{ $user->name }} - Change.org</title>
@endsection

@section('styles')
    {{-- Si tienes algún estilo específico para esta vista, puedes incluirlo aquí. --}}
    {{-- @link rel="stylesheet" href="{{ asset('css/user-details.css') }}" --}}
@endsection

@section('content')
    {{-- Contenedor principal centrado y con altura mínima --}}
    <div class="d-flex flex-column align-items-center min-vh-100 py-5" style="background-color: #f8f9fa;">
        <div class="card shadow-sm rounded-4" style="width: 100%; max-width: 600px;">
            <div class="card-body p-4 p-md-5">

                <div class="d-flex justify-content-between align-items-start mb-4">
                    <h1 class="fw-bold fs-2">Detalles del Usuario</h1>
                    {{-- Botón de edición para seguir la coherencia de un panel de administración --}}
                    <a href="{{ route('adminusers.edit', $user->id) }}" class="btn btn-outline-dark fw-bold py-2 px-3">
                        Editar Usuario
                    </a>
                </div>

                <hr class="mb-4">

                {{-- Sección de Información del Usuario --}}
                <div class="row mb-4">
                    {{-- Avatar/Ícono del Usuario (siguiendo el estilo de la vista de petición) --}}
                    <div class="col-auto">
                        <div class="bg-light-subtle rounded-circle d-flex justify-content-center align-items-center"
                             style="width: 70px; height: 70px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="#808080"
                                 class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                    </div>
                    {{-- Nombre y Correo --}}
                    <div class="col">
                        <h2 class="mb-0 fw-bold">{{ $user->name }}</h2>
                        <p class="text-muted fs-5">{{ $user->email }}</p>
                    </div>
                </div>

                <hr class="mt-0 mb-4">

                {{-- Lista de Detalles --}}
                <dl class="row">
                    {{-- ID --}}
                    <dt class="col-sm-4 text-muted">ID</dt>
                    <dd class="col-sm-8 fw-bold">{{ $user->id }}</dd>

                    {{-- Nombre --}}
                    <dt class="col-sm-4 text-muted">Nombre Completo</dt>
                    <dd class="col-sm-8">{{ $user->name }}</dd>

                    {{-- Correo Electrónico --}}
                    <dt class="col-sm-4 text-muted">Correo Electrónico</dt>
                    <dd class="col-sm-8">{{ $user->email }}</dd>

                    {{-- Estado de Administrador --}}
                    <dt class="col-sm-4 text-muted">Rol</dt>
                    <dd class="col-sm-8">
                        @if ($user->admin)
                            <span class="badge bg-danger text-uppercase fw-bold">Administrador</span>
                        @else
                            <span class="badge bg-secondary text-uppercase fw-bold">Usuario Estándar</span>
                        @endif
                    </dd>

                    {{-- Verificado --}}
                    <dt class="col-sm-4 text-muted">Verificado</dt>
                    <dd class="col-sm-8">
                        @if ($user->email_verified_at)
                            <span class="text-success fw-bold">Sí</span> ({{ $user->email_verified_at->diffForHumans() }})
                        @else
                            <span class="text-warning fw-bold">No</span>
                        @endif
                    </dd>

                    {{-- Fecha de Creación --}}
                    <dt class="col-sm-4 text-muted">Miembro Desde</dt>
                    <dd class="col-sm-8">{{ $user->created_at->format('d/m/Y H:i') }}</dd>

                    {{-- Última Actualización --}}
                    <dt class="col-sm-4 text-muted">Última Actualización</dt>
                    <dd class="col-sm-8">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>

                </dl>

                <hr class="mt-4 mb-4">

                {{-- Botón para volver al listado --}}
                <div class="d-flex justify-content-end">
                    <a href="{{ route('adminusers.index') }}" class="btn btn-outline-secondary fw-bold px-4 py-2">
                        Volver al Listado
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

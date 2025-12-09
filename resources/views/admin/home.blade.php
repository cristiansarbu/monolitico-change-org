@php
    use Illuminate\Support\Facades\Auth;
@endphp

@extends('layouts.admin')

@section('title')
    <title>Admin Dashboard - Change.org</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
    <style>
        /* Estilos de la barra lateral */
        .sidebar {
            width: 250px; /* Ancho de la sidebar */
            background-color: #e4202c !important; /* El color rojo intenso */
            z-index: 1030; /* Asegura que esté sobre otros elementos */
            min-height: 100vh; /* Asegura que ocupe todo el alto */
        }

        /* Estilos para los elementos de la lista/menú */
        .sidebar .list-group-item {
            color: white !important; /* Texto blanco */
            padding-left: 0.5rem; /* Ajuste el padding */
        }

        /* Estilo al pasar el ratón (hover) */
        .sidebar .list-group-item:hover {
            background-color: rgba(0, 0, 0, 0.1); /* Ligero oscurecimiento al pasar el ratón */
            cursor: pointer;
        }

        /* Estilo para el contenedor principal de la tabla/header */
        .main-content {
            margin-left: 250px; /* Deja espacio para la sidebar fija */
            background-color: #f8f9fa; /* Color de fondo muy claro (grisáceo) */
            min-height: 100vh;
        }

        /* Ajuste para las pastillas de acción (círculos) */
        .action-circle {
            width: 35px;
            height: 35px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            color: white;
            font-size: 1.1rem;
            margin-right: 5px;
        }

        /* Estilos para los avatares en la tabla */
        .table-avatar {
            width: 40px;
            height: 40px;
            background-color: #ced4da; /* Gris claro */
            border-radius: 50%;
            /* La imagen de la captura parece ser un degradado gris, pero usamos color plano para simplicidad */
        }
    </style>
@endsection

@section('content')
        <div class="d-flex">

            <div class="sidebar d-flex flex-column p-0 text-white position-fixed">

                <div class="p-3 text-center border-bottom border-light border-opacity-25" style="height: 57px;">
                    <span class="fs-4 fw-bold">change.org</span>
                </div>

                <div class="p-3 text-center mb-4">
                    <div class="d-flex flex-column align-items-center">
                        <img src="https://i.pravatar.cc/70?img=4" alt="Admin Avatar" class="rounded-circle mb-2 border border-3 border-white">
                        <span class="fw-semibold">Admin</span>
                    </div>
                </div>

                <div class="p-3 pt-0">
                    <p class="text-uppercase fw-bold opacity-75 mb-2 small">Main Menu</p>
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
                        <button class="btn btn-primary me-3 text-white">New</button>
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
                                    <tr>
                                        <td>13</td>
                                        <td>ppguyyyyyjijysdsdsdwewewew</td>
                                        <td>pp</td>
                                        <td>1</td>
                                        <td><span class="badge bg-warning text-dark">pendiente</span></td>
                                        <td>
                                            <a href="#" class="action-circle bg-success"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="action-circle" style="background-color: #9c27b0;"><i class="bi bi-folder-fill"></i></a>
                                            <a href="#" class="action-circle bg-danger"><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>14</td>
                                        <td>hhh</td>
                                        <td>h</td>
                                        <td>0</td>
                                        <td><span class="badge bg-primary">aceptada</span></td>
                                        <td>
                                            <a href="#" class="action-circle bg-success"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="action-circle" style="background-color: #9c27b0;"><i class="bi bi-folder-fill"></i></a>
                                            <a href="#" class="action-circle bg-danger"><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>15</td>
                                        <td>ppguyyyyyjijysdsdsdwewewew</td>
                                        <td>pp</td>
                                        <td>2</td>
                                        <td><span class="badge bg-warning text-dark">pendiente</span></td>
                                        <td>
                                            <a href="#" class="action-circle bg-success"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="action-circle" style="background-color: #9c27b0;"><i class="bi bi-folder-fill"></i></a>
                                            <a href="#" class="action-circle bg-danger"><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>16</td>
                                        <td>hhh</td>
                                        <td>h</td>
                                        <td>0</td>
                                        <td><span class="badge bg-primary">aceptada</span></td>
                                        <td>
                                            <a href="#" class="action-circle bg-success"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="action-circle" style="background-color: #9c27b0;"><i class="bi bi-folder-fill"></i></a>
                                            <a href="#" class="action-circle bg-danger"><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>17</td>
                                        <td>ppguyyyyyjijysdsdsdwewewew</td>
                                        <td>pp</td>
                                        <td>0</td>
                                        <td><span class="badge bg-warning text-dark">pendiente</span></td>
                                        <td>
                                            <a href="#" class="action-circle bg-success"><i class="bi bi-pencil-fill"></i></a>
                                            <a href="#" class="action-circle" style="background-color: #9c27b0;"><i class="bi bi-folder-fill"></i></a>
                                            <a href="#" class="action-circle bg-danger"><i class="bi bi-trash-fill"></i></a>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <nav class="mt-3">
                        <ul class="pagination pagination-sm justify-content-start">
                            <li class="page-item disabled"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </nav>

                </div>

            </div>
        </div>
@endsection

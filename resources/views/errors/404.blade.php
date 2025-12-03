@extends('layouts.public')

@section('title')
    <title>Página no encontrada - Change.org</title>
@endsection

@section('styles')
@endsection

@section('content')
    <div class="container py-5 error-container">
        <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">

            <h1 class="display-1 fw-bold text-danger mb-3">
                404
            </h1>
            <h2 class="display-5 fw-light text-secondary mb-4">
                Página No Encontrada
            </h2>
            <p class="lead text-muted mb-5 px-4 mx-auto" style="max-width: 600px;">
                ¡Lo sentimos! La dirección web que intentaste acceder no existe en nuestro sitio, ha sido eliminada o movida.
            </p>
            <a href="{{ url('/') }}" class="btn btn-secondary btn-lg shadow-sm">
                Volver a la Página Principal
            </a>
        </div>
    </div>
@endsection

@extends('layouts.public')

@section('title')
    <title>Recuperar Contraseña - Change.org</title>
@endsection

@section('content')
    <div class="d-flex flex-column align-items-center min-vh-100 py-5" style="background-color: #f8f9fa;">

        <div class="card shadow-sm rounded-4" style="width: 100%; max-width: 420px;">
            <div class="card-body p-4 p-md-5">

                <div class="mb-4 text-muted">
                    {{ __('¿Olvidaste tu contraseña? No hay problema. Solo déjanos tu correo electrónico y te enviaremos un enlace para restablecerla.') }}
                </div>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="form-label text-muted">Correo Electrónico</label>
                        <input id="email"
                               type="email"
                               name="email"
                               class="form-control form-control-lg"
                               value="{{ old('email') }}"
                               required
                               autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-dark text-uppercase px-4 py-2">
                            Enviar enlace
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

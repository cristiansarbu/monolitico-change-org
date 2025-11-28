@extends('layouts.public')

@section('title')
    <title>Registrarse - Change.org</title>
@endsection

@section('content')
    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-md-5">

                {{-- CARD IGUAL QUE EL DE BREEZE --}}
                <div class="card shadow-sm border-0">

                    <div class="card-body p-4">

                        {{-- LOGO COMO EN X-GUEST-LAYOUT --}}
                        <div class="text-center mb-4">
                            <a href="/">
                                <img src="{{ asset('logo.png') }}" alt="Laravel Logo" class="img-fluid" style="width: 85px;">
                            </a>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Nombre --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                                <input id="name"
                                       type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       value="{{ old('name') }}"
                                       required autofocus autocomplete="name">

                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                                <input id="email"
                                       type="email"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       value="{{ old('email') }}"
                                       required autocomplete="username">

                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                                <input id="password"
                                       type="password"
                                       name="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       required autocomplete="new-password">

                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                                <input id="password_confirmation"
                                       type="password"
                                       name="password_confirmation"
                                       class="form-control @error('password_confirmation') is-invalid @enderror"
                                       required autocomplete="new-password">

                                @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Actions --}}
                            <div class="d-flex justify-content-between align-items-center">

                                <a href="{{ route('login') }}"
                                   class="text-decoration-underline text-secondary">
                                    {{ __('¿Ya estás registrado?') }}
                                </a>

                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarse') }}
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@extends('layouts.public')

@section('title')
    <title>Crear petición - Change.org</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/petitions.css') }}">
@endsection

@section('content')
    <main class="container d-flex justify-content-center mt-3">
        <div class="p-4 p-md-5 contenedor-todo">

            <h1 class="fw-bold fs-3 mb-2 fs-2rem">Primero, cuéntanos sobre tu causa</h1>
            <p class="text-body mb-4 fs-1125rem">
                Combinaremos tus palabras con nuestra experiencia para crearte el
                borrador de petición más impactante.
            </p>
            <div class="mb-5">
                <label for="inputCausa" class="form-label fw-bold">Quiero...</label>
                <textarea class="form-control" id="inputCausa" rows="5"
                          placeholder="Escribe aquí tu causa (ejemplo: Quiero que el gobierno cambie la ley de...)"></textarea>
            </div>


            <h1 class="fw-bold fs-3 mb-2 fs-2rem">Historia</h1>
            <p class="text-body mb-4 fs-1125rem">Añadir una historia personal hará que la petición sea más sólida.</p>
            <div class="mb-5">
                <label for="inputHistoria" class="form-label fw-bold">¿Por qué es personal para ti? (Opcional)</label>
                <textarea class="form-control" id="inputHistoria" rows="5"
                          placeholder="Escribe aquí tu historia..."></textarea>
            </div>


            <h1 class="fw-bold fs-3 mb-4 fs-2rem">Por último, ¿cuál es el alcance de tu petición?</h1>

            <div class="row row-cols-1 g-3 row-cols-md-3 mb-5">

                <div class="col">
                    <div
                        class="card card-alcance shadow p-3 text-center border-0 h-100 d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icono"
                             focusable="false">
                            <path
                                d="M19,9.3V4h-3v2.6L12,3L2,12h3v8h6v-6h2v6h6v-8h3L19,9.3z M17,18h-2v-6H9v6H7v-7.81l5-4.5l5,4.5V18z">
                            </path>
                            <path d="M10,10h4c0-1.1-0.9-2-2-2S10,8.9,10,10z"></path>
                        </svg>
                        <h5 class="fw-bold mb-0">Local</h5>
                    </div>
                </div>

                <div class="col">
                    <div
                        class="card card-alcance shadow p-3 text-center border-0 h-100 d-flex flex-column justify-content-center align-items-center">
                        <svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                             aria-hidden="true" class="icono" focusable="false" style="fill: currentcolor;">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                  d="M8.12852 15.0059C8.61669 12.4526 10.9473 10.5696 13.7491 10.0072V3.07486C13.7491 2.52257 14.1968 2.07486 14.7491 2.07486H19.4781C19.7433 2.07486 19.9977 2.18022 20.1852 2.36775C20.3727 2.55529 20.4781 2.80964 20.4781 3.07486V3.5059H23.4189L25.7834 6.6586L23.4189 9.8113H18.6898V8.80391H15.7491V9.83696C19.1835 9.93301 22.2982 12.0072 22.8715 15.0059H25.4138C25.9661 15.0059 26.4138 15.4536 26.4138 16.0059C26.4138 16.5582 25.9661 17.0059 25.4138 17.0059H24.5517V18.4542H28C28.5523 18.4542 29 18.9019 29 19.4542C29 20.0065 28.5523 20.4542 28 20.4542H26.7069V27.9369H28C28.5523 27.9369 29 28.3847 29 28.9369C29 29.4892 28.5523 29.9369 28 29.9369L3 29.9369C2.44772 29.9369 2 29.4892 2 28.9369C2 28.3847 2.44772 27.9369 3 27.9369H4.01724L4.01724 20.4542H3C2.44772 20.4542 2 20.0065 2 19.4542C2 18.9019 2.44772 18.4542 3 18.4542H6.17242V17.0059H5.5862C5.03392 17.0059 4.5862 16.5582 4.5862 16.0059C4.5862 15.4536 5.03392 15.0059 5.5862 15.0059H8.12852ZM15.5 11.8335C18.2202 11.8335 20.227 13.2904 20.7995 15.0059L10.2005 15.0059C10.773 13.2904 12.7798 11.8335 15.5 11.8335ZM18.4781 6.80391H15.7491V4.07486L18.4781 4.07486V6.80391ZM24.7069 20.4542H21.9655V27.9369H24.7069V20.4542ZM22.5517 17.0059V18.4542L8.17242 18.4542V17.0059L22.5517 17.0059ZM19.9655 20.4542V27.9369H16.3621V20.4542H19.9655ZM14.3621 20.4542V27.9369H10.7586V20.4542H14.3621ZM8.75862 27.9369L8.75862 20.4542H6.01724L6.01724 27.9369H8.75862ZM20.6898 5.5059H22.4189L23.2834 6.6586L22.4189 7.8113H20.6898V5.5059Z">
                            </path>
                        </svg>
                        <h5 class="fw-bold mb-0">Nacional</h5>
                    </div>
                </div>

                <div class="col">
                    <div
                        class="card p-custom card-alcance border-0 shadow p-3 text-center h-100 d-flex flex-column justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                             aria-hidden="true" class="icono" focusable="false" style="fill: currentcolor;">
                            <path
                                d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM4 12c0-.61.08-1.21.21-1.78L8.99 15v1c0 1.1.9 2 2 2v1.93C7.06 19.43 4 16.07 4 12zm13.89 5.4c-.26-.81-1-1.4-1.9-1.4h-1v-3c0-.55-.45-1-1-1h-6v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41C17.92 5.77 20 8.65 20 12c0 2.08-.81 3.98-2.11 5.4z">
                            </path>
                        </svg>
                        <h5 class="fw-bold mb-0 text-dark-emphasis">Global</h5>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-3">
                <button type="button" class="btn btn-outline-secondary fw-bold text-body px-4 py-2">
                    Volver
                </button>
                <button type="button" class="button-create-petition px-3 fw-bold text-body">
                    Continuar
                </button>
            </div>
        </div>
    </main>
@endsection

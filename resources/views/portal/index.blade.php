@extends('layouts.app')

@section('title', 'Portal')

@section('content')

<!-- BANNER -->
<section class="portal-hero">
    <div class="portal-hero-overlay">
        <div class="portal-hero-content">
            {{-- Imagen superior --}}
            <img src="{{ asset('/images/portal/logo-ignite-white.png') }}" class="portal-event-logo" alt="Evento">

            <p class="portal-description">
                3 días de reflexión estratégica, conexiones de alto nivel y visión de industria en un entorno
                excepcional.
            </p>

            {{-- Fecha --}}
            <div class="portal-date-btn">
                <i class="fa fa-calendar"></i>

                <span>
                    FECHA
                </span>
            </div>

            <p class="portal-date-text">
                Del 31 de Agosto al 02 Septiembre de 2026
            </p>

            {{-- Botones --}}
            <div class="portal-actions">
                <a href="#programa" class="portal-btn-program">
                    VER PROGRAMA
                </a>

                <a href="#registro" class="portal-btn-outline">
                    REGISTRO
                </a>
            </div>
        </div>
    </div>
</section>
<!-- BANNER -->

<!-- GRID -->
<section class="portal-gallery">

    <div class="portal-gallery-grid">

        <div class="portal-gallery-item">
            <img
                src="{{ asset('../images/portal/foto-1.webp') }}"
                alt="Galería 1">
        </div>


        <div class="portal-gallery-item">
            <img
                src="{{ asset('../images/portal/foto-2.webp') }}"
                alt="Galería 2">
        </div>


        <div class="portal-gallery-item">
            <img
                src="{{ asset('../images/portal/foto-3.webp') }}"
                alt="Galería 3">
        </div>


        <div class="portal-gallery-item">
            <img
                src="{{ asset('../images/portal/foto-4.webp') }}"
                alt="Galería 4">
        </div>

    </div>

</section>
<!-- GRID -->

<!-- SEDE -->
<section class="portal-location-header">
    <div class="portal-location-overlay">
        <div class="portal-location-title">
            <h2>
                Sede del evento
            </h2>
            <p>
                Hilton Cancun, an All-Inclusive Resort es un lujoso hotel de playa ubicado en la zona costera hacia Puerto Morelos.
            </p>
        </div>
    </div>
</section>

<section class="portal-location-bg">
    <div class="portal-location-overlay">
        <div class="portal-location-content">
            <div class="portal-hotel-logo">
                <img src="{{ asset('images/portal/logo-hilton.webp') }}" alt="Hilton Cancun">
            </div>

            <div class="portal-hotel-grid">
                {{-- Galería --}}
                <div class="portal-hotel-gallery">
                    <div class="hotel-gallery-main">
                        <img src="{{ asset('images/portal/exterior-uno.webp') }}" alt="Hilton Cancun">
                    </div>

                    <div class="hotel-gallery-small">
                        <img src="{{ asset('images/portal/exterior-dos.webp') }}" alt="Hilton Cancun">

                        <img src="{{ asset('images/portal/exterior-tres.webp') }}" alt="Hilton Cancun">
                    </div>
                </div>

                {{-- Mapa --}}
                <div class="portal-hotel-map">
                    <iframe
                        src="https://www.google.com/maps?q=Hilton%20Cancun%20an%20All-Inclusive%20Resort&output=embed"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- SEDE -->

{{-- SECCIÓN INCLUYE TU REGISTRO --}}
<section class="include-header-bg">
    <div class="portal-location-overlay">
        <div class="incluye-header">

            <div class="container text-center">

                <h2>
                    ¿Qué incluye tu registro?
                </h2>

                <p>
                    Tu pase de participante cubre todo lo necesario para vivir la experiencia<br> completa del Ignite.
                </p>
            </div>
        </div>
    </div>

</section>

<section class="include-content-bg ">
    <div class="incluye-content">
        <div class="container">
            <div class="incluye-cards-wrapper">
                {{-- NO INCLUIDO --}}
                <div class="incluye-card">
                    <div class="incluye-card-title no-incluido">
                        <span>
                            No incluido
                        </span>

                        <i class="fa fa-times"></i>
                    </div>

                    <ul>
                        <li>
                            Servicio de lavandería.
                        </li>
                        <li>
                            Compras en tabaquería.
                        </li>
                        <li>
                            Tour.
                        </li>
                        <li>
                            Transportación.
                        </li>
                    </ul>
                </div>

                {{-- INCLUIDO --}}
                <div class="incluye-card">
                    <div class="incluye-card-title incluido">
                        <i class="fa fa-check"></i>

                        <span>
                            Incluido en tu pase
                        </span>
                    </div>

                    <ul>
                        <li>
                            Bebida de bienvenida y toalla fresca a la llegada.
                        </li>
                        <li>
                            Desayuno, almuerzo y cena diarios, y refrigerios en hasta seis restaurantes del Resort de forma continua durante las horas de atención al público.
                        </li>
                        <li>
                            Selección ilimitada de bebidas y cócteles especiales del Resort en bares y restaurantes seleccionados durante las horas de atención al público.
                        </li>
                        <li>
                            Acceso al Kid's & Teen's Club y actividades.
                        </li>
                        <li>
                            Dulces ilimitados disponibles en la heladería y el puesto de dulces durante las horas de atención al público.
                        </li>
                        <li>
                            Acceso a la piscina familiar y de adultos, y al servicio de playa.
                        </li>
                        <li>
                            Wifi estándar ilimitado en todo el Resort para todos los participantes del Grupo.
                        </li>
                        <li>
                            Actividades diarias variadas del Resort y espectáculos nocturnos en vivo.
                        </li>
                        <li>
                            Acceso al gimnasio y otras actividades wellness.
                        </li>
                        <li>
                            Servicio a cuartos.
                        </li>
                        <li>
                            Seguridad 24 horas.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- CHECK-IN -->
<section class="portal-checkin" id="registro">
    <div class="portal-section-heading text-center">

        <h2 class="dresscode-header">
            Proceso de Check-in
        </h2>

        <p class="portal-section-label">
            Información de llegada
        </p>

    </div>

    <div id="schedule-list"></div>
</section>
<!-- CHECK-IN -->

<!-- PROGRAMA DEL EVENTO -->
<section class="portal-schedule" id="programa">
    <div class="portal-section-heading">
        <span class="portal-section-label">
            Agenda del evento
        </span>

        <h2 class="portal-section-title">
            Programa
        </h2>

        <p class="schedule-intro">
            Consulta las actividades programadas durante el evento,
            organizadas por día.
        </p>
    </div>

    <!-- Navegación de días -->
    <nav class="schedule-nav">
        <button class="active" data-day="day1">
            31 AGO
        </button>

        <button data-day="day2">
            01 SEP
        </button>

        <button data-day="day3">
            02 SEP
        </button>

        <button data-day="day4">
            03 SEP
        </button>
    </nav>

    <!-- Contenedor dinámico -->
    <div id="event-schedule-list"></div>
</section>
<!-- PROGRAMA DEL EVENTO -->


{{-- CÓDIGO DE VESTIMENTA --}}
<section class="dresscode-header-bg">
    <div class="portal-location-overlay">
        <div class="dresscode-section">
            <div class="container">
                <div class="dresscode-header text-center">
                    <h2>
                        Código de vestimenta
                    </h2>

                    <p>
                        El código de vestimenta para las actividades del evento, podemos compartir los siguientes ejemplos:
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        {{-- DAMAS --}}
        <div class="dresscode-card">
            <div class="dresscode-info">
                <h3>
                    Vestimenta para las
                    <span>
                        Damas
                    </span>
                </h3>

                <a href="https://pin.it/5yK3vzdkV" target="_blank" class="dresscode-btn">
                    Ver ejemplos
                </a>
            </div>

            <div class="dresscode-image">
                <img src="{{ asset('../images/portal/referencia-mujer.webp') }}" alt="Vestimenta para damas">

            </div>
        </div>

        {{-- CABALLEROS --}}
        <div class="dresscode-card">
            <div class="dresscode-image">
                <img src="{{ asset('../images/portal/referencia-hombre.webp') }}" alt="Vestimenta para caballeros">
            </div>

            <div class="dresscode-info">
                <h3>
                    Vestimenta para los
                    <span>
                        Caballeros
                    </span>
                </h3>

                <a href="https://pin.it/2vQNdxoXv" target="_blank" class="dresscode-btn">
                    Ver ejemplos
                </a>
            </div>
        </div>
    </div>
</section>

<!-- <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card mera-card">
                <div class="card-body text-center py-5">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 90px;" class="mb-4">

                    <h2 class="mera-title mb-3">
                        ¡Bienvenido, {{ auth()->user()->fullName() }}!
                    </h2>

                    <p class="mera-subtitle mb-4">
                        Has iniciado sesión correctamente en el portal.
                    </p>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-4">
                            <h6 class="text-muted">
                                Número de empleado
                            </h6>

                            <strong>
                                {{ auth()->user()->employee_number ?? 'No asignado' }}
                            </strong>
                        </div>

                        <div class="col-md-4">
                            <h6 class="text-muted">
                                Correo electrónico
                            </h6>

                            <strong>
                                {{ auth()->user()->email }}
                            </strong>
                        </div>

                        <div class="col-md-4">
                            <h6 class="text-muted">
                                País
                            </h6>

                            <strong>
                                {{ auth()->user()->country ?? 'No asignado' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection
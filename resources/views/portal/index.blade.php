@extends('layouts.app')

@section('title', __('portal.title'))

@section('content')

<!-- BANNER -->
<section class="portal-hero">
    <div class="portal-hero-overlay">
        <div class="portal-hero-content">

            {{-- Imagen superior --}}
            <img
                src="{{ asset('/images/portal/logo-ignite-white.png') }}"
                class="portal-event-logo"
                alt="{{ __('portal.banner.event_logo_alt') }}">

            <p class="portal-description">
                {{ __('portal.banner.description') }}
            </p>

            {{-- Fecha --}}
            <div class="portal-date-btn">
                <i class="fa fa-calendar"></i>

                <span>
                    {{ __('portal.banner.date_label') }}
                </span>
            </div>

            <p class="portal-date-text">
                {{ __('portal.banner.date') }}
            </p>

            {{-- Botones --}}
            <div class="portal-actions">
                <a href="#programa" class="portal-btn-program">
                    {{ __('portal.banner.view_program') }}
                </a>

                <a href="#registro" class="portal-btn-outline">
                    {{ __('portal.banner.registration') }}
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
                alt="{{ __('portal.gallery.image_1') }}">
        </div>

        <div class="portal-gallery-item">
            <img
                src="{{ asset('../images/portal/foto-2.webp') }}"
                alt="{{ __('portal.gallery.image_2') }}">
        </div>

        <div class="portal-gallery-item">
            <img
                src="{{ asset('../images/portal/foto-3.webp') }}"
                alt="{{ __('portal.gallery.image_3') }}">
        </div>

        <div class="portal-gallery-item">
            <img
                src="{{ asset('../images/portal/foto-4.webp') }}"
                alt="{{ __('portal.gallery.image_4') }}">
        </div>

    </div>

</section>
<!-- GRID -->

{{-- =========================================================
     CONTADOR
========================================================== --}}
<section class="gala-countdown">

    <div class="gala-countdown-label">
        {{ __('portal.gala.countdown.label') }}
    </div>

    <p class="gala-countdown-note">
        {{ __('portal.gala.countdown.note') }}
    </p>

    <div
        class="gala-countdown-grid"
        id="galaCountdown"
        data-target="2026-08-31T23:59:59-05:00">

        <div class="gala-countdown-item">

            <span
                class="gala-countdown-number"
                id="countdown-days">
                00
            </span>

            <span class="gala-countdown-unit">
                {{ __('portal.gala.countdown.days') }}
            </span>

        </div>


        <div class="gala-countdown-separator">
            :
        </div>


        <div class="gala-countdown-item">

            <span
                class="gala-countdown-number"
                id="countdown-hours">
                00
            </span>

            <span class="gala-countdown-unit">
                {{ __('portal.gala.countdown.hours') }}
            </span>

        </div>


        <div class="gala-countdown-separator">
            :
        </div>


        <div class="gala-countdown-item">

            <span
                class="gala-countdown-number"
                id="countdown-minutes">
                00
            </span>

            <span class="gala-countdown-unit">
                {{ __('portal.gala.countdown.minutes') }}
            </span>

        </div>


        <div class="gala-countdown-separator">
            :
        </div>


        <div class="gala-countdown-item">

            <span
                class="gala-countdown-number"
                id="countdown-seconds">
                00
            </span>

            <span class="gala-countdown-unit">
                {{ __('portal.gala.countdown.seconds') }}
            </span>

        </div>

    </div>
</section>

<!-- SEDE -->
<section class="portal-location-header">
    <div class="portal-location-overlay">
        <div class="portal-location-title">

            <h2>
                {{ __('portal.location.title') }}
            </h2>

            <p>
                {{ __('portal.location.description') }}
            </p>

        </div>
    </div>
</section>

<section class="portal-location-bg">
    <div class="portal-location-overlay">
        <div class="portal-location-content">

            <div class="portal-hotel-logo">
                <img
                    src="{{ asset('images/portal/logo-hilton.webp') }}"
                    alt="Hilton Cancun">
            </div>

            <div class="portal-hotel-grid">

                {{-- Galería --}}
                <div class="portal-hotel-gallery">

                    <div class="hotel-gallery-main">
                        <img
                            src="{{ asset('images/portal/exterior-uno.webp') }}"
                            alt="Hilton Cancun">
                    </div>

                    <div class="hotel-gallery-small">

                        <img
                            src="{{ asset('images/portal/exterior-dos.webp') }}"
                            alt="Hilton Cancun">

                        <img
                            src="{{ asset('images/portal/exterior-tres.webp') }}"
                            alt="Hilton Cancun">

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
                    {{ __('portal.registration.includes_title') }}
                </h2>

                <p>
                    {!! __('portal.registration.includes_description') !!}
                </p>

            </div>

        </div>

    </div>
</section>

<section class="include-content-bg">

    <div class="incluye-content">

        <div class="container">

            <div class="incluye-cards-wrapper">

                {{-- NO INCLUIDO --}}
                <div class="incluye-card">

                    <div class="incluye-card-title no-incluido">

                        <span>
                            {{ __('portal.registration.not_included_title') }}
                        </span>

                        <i class="fa fa-times"></i>

                    </div>

                    <ul>

                        <li>
                            {{ __('portal.registration.not_included.laundry') }}
                        </li>

                        <li>
                            {{ __('portal.registration.not_included.tobacco') }}
                        </li>

                        <li>
                            {{ __('portal.registration.not_included.tours') }}
                        </li>

                        <li>
                            {{ __('portal.registration.not_included.transportation') }}
                        </li>

                        <li>
                            {{ __('portal.registration.not_included.minibar') }}
                        </li>

                        <li>
                            {{ __('portal.registration.not_included.room_service') }}
                        </li>

                    </ul>

                </div>


                {{-- INCLUIDO --}}
                <div class="incluye-card">

                    <div class="incluye-card-title incluido">

                        <i class="fa fa-check"></i>

                        <span>
                            {{ __('portal.registration.included_title') }}
                        </span>

                    </div>

                    <ul>

                        <li>
                            {{ __('portal.registration.included.welcome' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.meals' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.drinks' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.sweets' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.pool_beach' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.wifi' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.activities' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.gym' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.security' ) }}
                        </li>

                        <li>
                            {{ __('portal.registration.included.spa' ) }}
                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</section>
{{-- SECCIÓN INCLUYE TU REGISTRO --}}

<!-- CHECK-IN -->
<section class="portal-checkin" id="registro">

    <div class="portal-section-heading text-center">

        <h2 class="dresscode-header">
            {{ __('portal.checkin.title') }}
        </h2>

        <p class="portal-section-label">
            {{ __('portal.checkin.date') }}
        </p>

    </div>

    <div id="schedule-list"></div>

</section>
<!-- CHECK-IN -->

<!-- PROGRAMA DEL EVENTO -->
<section class="portal-schedule" id="programa">

    <div class="portal-section-heading">

        <span class="portal-section-label">
            {{ __('portal.schedule.label') }}
        </span>

        <h2 class="portal-section-title">
            {{ __('portal.schedule.title') }}
        </h2>

        <p class="schedule-intro">
            {{ __('portal.schedule.description') }}
        </p>

    </div>


    <!-- Navegación de días -->
    <nav class="schedule-nav">

        <button class="active" data-day="day1">
            {{ __('portal.schedule.days.day1') }}
        </button>

        <button data-day="day2">
            {{ __('portal.schedule.days.day2') }}
        </button>

        <button data-day="day3">
            {{ __('portal.schedule.days.day3') }}
        </button>

        <button data-day="day4">
            {{ __('portal.schedule.days.day4') }}
        </button>

    </nav>


    <!-- Contenedor dinámico -->
    <div id="event-schedule-list"></div>

</section>
<!-- PROGRAMA DEL EVENTO -->

{{-- =========================================================
     speaker
========================================================== --}}
<section class="speaker-section">

    <div class="speaker-label">
        {{ __('portal.speakers.title') }}
    </div>

    <p class="speaker-note">
        {{ __('portal.speakers.description') }}
    </p>

    @foreach (__('portal.speakers') as $key => $speaker)

    @if (is_numeric($key))

    <div class="speaker-content">

        <div class="speaker-image">
            <img
                src="../images/portal/ponente-{{ $key }}.png"
                alt="{{ $speaker['image_alt'] }}">
        </div>

        <h2 class="speaker-name">
            {{ $speaker['name'] }}
        </h2>

        <h3 class="speaker-workshop">
            {{ $speaker['workshop'] }}
        </h3>

        <div class="speaker-description-wrapper">

            <p class="speaker-description">
                {{ $speaker['description_1'] }}
            </p>

            <p class="speaker-description">
                {{ $speaker['description_2'] }}
            </p>

            <p class="speaker-description">
                {{ $speaker['description_3'] }}
            </p>

        </div>

    </div>

    @endif

    @endforeach

</section>

{{-- CÓDIGO DE VESTIMENTA --}}
<section class="dresscode-header-bg">

    <div class="portal-location-overlay">

        <div class="dresscode-section">

            <div class="container">

                <div class="dresscode-header text-center">

                    <h2>
                        {{ __('portal.dresscode.title') }}
                    </h2>

                    <p>
                        {{ __('portal.dresscode.description') }}
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
                    {{ __('portal.dresscode.ladies.title') }}

                    <span>
                        {{ __('portal.dresscode.ladies.highlight') }}
                    </span>
                </h3>

                <a
                    href="https://pin.it/5yK3vzdkV"
                    target="_blank"
                    class="dresscode-btn">
                    {{ __('portal.dresscode.view_examples') }}
                </a>

            </div>

            <div class="dresscode-image">
                <!-- <img
                    src="{{ asset('../images/portal/referencia-mujer.webp') }}"
                    alt="{{ __('portal.dresscode.ladies.image_alt') }}"> -->

                <img
                    src="{{ asset('../images/portal/Referencia mujer_.png') }}"
                    alt="{{ __('portal.dresscode.ladies.image_alt') }}">
            </div>
        </div>

        {{-- CABALLEROS --}}
        <div class="dresscode-card">
            <div class="dresscode-image">
                <!-- <img
                    src="{{ asset('../images/portal/referencia-hombre.webp') }}"
                    alt="{{ __('portal.dresscode.men.image_alt') }}"> -->

                <img
                    src="{{ asset('../images/portal/Referencia hombre_.png') }}"
                    alt="{{ __('portal.dresscode.ladies.image_alt') }}">
            </div>

            <div class="dresscode-info">

                <h3>
                    {{ __('portal.dresscode.men.title') }}

                    <span>
                        {{ __('portal.dresscode.men.highlight') }}
                    </span>
                </h3>

                <a
                    href="https://pin.it/2vQNdxoXv"
                    target="_blank"
                    class="dresscode-btn">
                    {{ __('portal.dresscode.view_examples') }}
                </a>

            </div>

        </div>

    </div>

</section>

{{-- CENA DE GALA --}}
<!-- <section class="dresscode-header-bg">

    <div class="portal-location-overlay">

        <div class="dresscode-section">

            <div class="container">

                <div class="dresscode-header text-center">

                    <h2>
                        {{ __('portal.dresscode.title') }}
                    </h2>

                    <p>
                        {{ __('portal.dresscode.description') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

</section> -->

<script>
    const language = "{{ app()->getLocale() }}";
</script>

<section class="dress_code">
    <img
        src="{{ app()->getLocale() === 'en' ? '../images/portal/dress_code_en.png' : '../images/portal/dress_code.png' }}"
        alt="">
</section>

<section class="testimonio-header-bg">

    <div class="portal-location-overlay">

        <div class="testimonio-section">

            <div class="container">

                <div class="dresscode-header text-center">

                    <!-- <h3>
                    {{ __('portal.gala.form.title') }}                    
                    </h3> -->

                    <!-- <span>
                        {{ __('portal.gala.form.title') }}
                        {{ __('portal.dresscode.men.highlight') }}
                    </span> -->

                    <p>
                        {{ __('portal.gala.form.title') }}
                    </p>

                    <a
                        href="{{ route('encuesta') }}"
                        target="_blank"
                        class="dresscode-btn">
                        {{ __('portal.gala.form.button') }}
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


@endsection
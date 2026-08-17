@extends('layouts.app')

@section('title', __('portal.gala.title'))

@section('content')

<style>
    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        color: #0B2318;
        min-height: 100vh;
        background: #024D25;
        position: relative;
        overflow-x: hidden;
    }

    .backdrop {
        position: fixed;
        inset: 0;
        z-index: 0;
        background-size: cover;
        background-position: center;
        opacity: 0.29;
        /* background-image: url('../images/encuesta/bg-encuesta.jpg'); */
        background-image: url('../images/encuesta/bg-encuesta.jpg');
        
    }

    .backdrop-base {
        position: fixed;
        inset: 0;
        z-index: -1;
        background: linear-gradient(
            165deg,
            #03301a 0%,
            #04502a 55%,
            #0c6b3e 100%
        );
    }

    .pcoded-main-container {
        background: transparent;
    }

    .wrap {
        position: relative;
        z-index: 1;
        max-width: 640px;
        margin: 0 auto;
        padding: 56px 20px 80px;
    }

    header.hero {
        text-align: center;
        color: #FAF8F2;
        margin-bottom: 36px;
    }

    .logo-badge {
        width: 118px;
        height: 118px;
        margin: 0 auto 18px;
        display: block;
    }

    .eyebrow {
        font-size: 11px;
        letter-spacing: 0.28em;
        text-transform: uppercase;
        color: #E6CE8A;
        font-weight: 600;
        margin-bottom: 10px;
    }

    h1 {
        font-family: 'Montserrat', sans-serif;
        font-weight: 800;
        font-style: italic;
        font-size: clamp(28px, 6vw, 40px);
        line-height: 1.15;
        margin: 0 0 12px;
        letter-spacing: -0.01em;
    }

    .hero-sub {
        font-size: 14.5px;
        line-height: 1.6;
        color: rgba(250, 248, 242, 0.86);
        max-width: 440px;
        margin: 0 auto;
        font-weight: 400;
    }

    .card {
        background: rgba(250, 248, 242, 0.94);
        border-radius: 18px;
        padding: 34px 28px 30px;
        box-shadow: 0 24px 60px rgba(3, 26, 14, 0.35);
        border: 1px solid rgba(201, 162, 75, 0.35);
    }

    .field-group {
        margin-bottom: 28px;
    }

    label.field-label {
        display: block;
        font-size: 11px;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        font-weight: 700;
        color: #024D25;
        margin-bottom: 9px;
    }

    input[type="text"] {
        width: 100%;
        padding: 13px 14px;
        border-radius: 10px;
        border: 1.5px solid #D8D2C2;
        font-family: 'Montserrat', sans-serif;
        font-size: 15px;
        background: #fff;
        color: #0B2318;
        transition: border-color 0.15s ease;
    }

    input[type="text"]:focus {
        outline: none;
        border-color: #93C01F;
        box-shadow: 0 0 0 3px rgba(147, 192, 31, 0.18);
    }

    textarea {
        width: 100%;
        padding: 13px 14px;
        border-radius: 10px;
        border: 1.5px solid #D8D2C2;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        background: #fff;
        color: #0B2318;
        resize: vertical;
        min-height: 64px;
        transition: border-color 0.15s ease;
    }

    textarea:focus {
        outline: none;
        border-color: #93C01F;
        box-shadow: 0 0 0 3px rgba(147, 192, 31, 0.18);
    }

    .field-note {
        font-size: 11.5px;
        color: #8A8370;
        margin-top: 6px;
        line-height: 1.4;
    }

    .course {
        margin-bottom: 30px;
    }

    .course-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }

    .course-name {
        font-size: 12px;
        letter-spacing: 0.2em;
        text-transform: uppercase;
        font-weight: 700;
        color: #024D25;
        white-space: nowrap;
    }

    .course-rule {
        flex: 1;
        height: 1px;
        background: linear-gradient(
            90deg,
            #C9A24B,
            transparent
        );
    }

    .options {
        display: grid;
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .option {
        position: relative;
    }

    .option input {
        position: absolute;
        opacity: 0;
        width: 1px;
        height: 1px;
    }

    .option label {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 14px 16px;
        border: 1.5px solid #E4DFD1;
        border-radius: 12px;
        cursor: pointer;
        background: #fff;
        transition:
            border-color 0.15s ease,
            background 0.15s ease,
            box-shadow 0.15s ease;
    }

    .option label:hover {
        border-color: #88CBC4;
    }

    .option input:checked + label {
        border-color: #55882B;
        background:
            linear-gradient(
                0deg,
                rgba(147, 192, 31, 0.08),
                rgba(147, 192, 31, 0.08)
            ),
            #fff;
        box-shadow: 0 0 0 1px #55882B;
    }

    .radio-dot {
        flex: none;
        width: 19px;
        height: 19px;
        border-radius: 50%;
        border: 1.5px solid #C7C0AC;
        margin-top: 1px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: border-color 0.15s ease;
    }

    .option input:checked + label .radio-dot {
        border-color: #55882B;
    }

    .radio-dot::after {
        content: "";
        width: 9px;
        height: 9px;
        border-radius: 50%;
        background: #55882B;
        transform: scale(0);
        transition: transform 0.12s ease;
    }

    .option input:checked + label .radio-dot::after {
        transform: scale(1);
    }

    .option-text .option-name {
        font-weight: 600;
        font-size: 14.5px;
        line-height: 1.35;
        color: #0B2318;
        display: block;
        margin-bottom: 2px;
    }

    .option-letter {
        font-style: italic;
        font-weight: 700;
        color: #55882B;
        margin-right: 2px;
    }

    .submit-row {
        margin-top: 8px;
    }

    button.submit-btn {
        width: 100%;
        padding: 15px 18px;
        border: none;
        border-radius: 12px;
        background: #024D25;
        color: #FAF8F2;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14.5px;
        letter-spacing: 0.03em;
        cursor: pointer;
        transition:
            background 0.15s ease,
            opacity 0.15s ease,
            transform 0.1s ease;
    }

    button.submit-btn:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    button.submit-btn:not(:disabled):hover {
        background: #55882B;
    }

    button.submit-btn:not(:disabled):active {
        transform: translateY(1px);
    }

    .hint {
        font-size: 12px;
        color: #8A8370;
        margin-top: 10px;
        text-align: center;
    }

    .error-msg {
        font-size: 12.5px;
        color: #A3372A;
        margin-top: 10px;
        text-align: center;
        display: none;
    }

    /* =========================================================
       CONFIRMATION TICKET
    ========================================================== */

    .ticket {
        display: none;
    }

    .ticket.show {
        display: block;
    }

    .ticket-check {
        width: 52px;
        height: 52px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: #93C01F;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .ticket h2 {
        text-align: center;
        font-style: italic;
        font-weight: 800;
        font-size: 22px;
        margin: 0 0 6px;
        color: #024D25;
    }

    .ticket .ticket-sub {
        text-align: center;
        font-size: 13.5px;
        color: #6B6552;
        margin-bottom: 26px;
    }

    .ticket-row {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        padding: 14px 0;
        border-bottom: 1px dashed #DAD3BF;
    }

    .ticket-row:last-child {
        border-bottom: none;
    }

    .ticket-row .k {
        font-size: 10.5px;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        font-weight: 700;
        color: #55882B;
        flex: none;
        width: 110px;
    }

    .ticket-row .v {
        font-size: 13.5px;
        color: #0B2318;
        text-align: right;
        line-height: 1.4;
    }

    .edit-link {
        display: block;
        text-align: center;
        margin-top: 22px;
        font-size: 12.5px;
        color: #55882B;
        text-decoration: underline;
        cursor: pointer;
        background: none;
        border: none;
        font-family: 'Montserrat', sans-serif;
    }

    /* =========================================================
       FOOTER
    ========================================================== */

    footer {
        text-align: center;
        margin-top: 26px;
    }

    footer button.admin-link {
        background: none;
        border: none;
        color: rgba(250, 248, 242, 0.55);
        font-family: 'Montserrat', sans-serif;
        font-size: 11.5px;
        letter-spacing: 0.08em;
        cursor: pointer;
        text-decoration: underline;
    }

    /* =========================================================
       MODAL
    ========================================================== */

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(3, 20, 10, 0.72);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 50;
        padding: 20px;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal {
        background: #FAF8F2;
        border-radius: 16px;
        max-width: 560px;
        width: 100%;
        max-height: 82vh;
        overflow-y: auto;
        padding: 26px 24px;
    }

    .modal h3 {
        font-style: italic;
        font-weight: 800;
        color: #024D25;
        margin: 0 0 14px;
        font-size: 19px;
    }

    .modal input[type="password"] {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1.5px solid #D8D2C2;
        font-family: 'Montserrat', sans-serif;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .modal button.primary {
        background: #024D25;
        color: #FAF8F2;
        border: none;
        padding: 11px 16px;
        border-radius: 10px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 13px;
        cursor: pointer;
        width: 100%;
    }

    .modal button.secondary {
        background: none;
        border: none;
        color: #55882B;
        text-decoration: underline;
        font-family: 'Montserrat', sans-serif;
        font-size: 12.5px;
        cursor: pointer;
        margin-top: 10px;
        display: block;
        width: 100%;
        text-align: center;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        margin: 14px 0 18px;
    }

    .summary-cell {
        background: #fff;
        border: 1px solid #E4DFD1;
        border-radius: 10px;
        padding: 10px 12px;
    }

    .summary-cell .n {
        font-weight: 800;
        font-size: 19px;
        color: #024D25;
    }

    .summary-cell .l {
        font-size: 10.5px;
        color: #7A7460;
        line-height: 1.3;
    }

    table.resp-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 11.5px;
        margin-top: 10px;
    }

    table.resp-table th {
        text-align: left;
        font-size: 9.5px;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #8A8370;
        padding: 6px 6px;
        border-bottom: 1.5px solid #DAD3BF;
    }

    table.resp-table td {
        padding: 7px 6px;
        border-bottom: 1px solid #EFEADF;
        vertical-align: top;
    }

    .modal-msg {
        font-size: 12.5px;
        color: #A3372A;
        margin-bottom: 10px;
        display: none;
    }

    .count-pill {
        font-size: 11px;
        color: #6B6552;
        margin-bottom: 6px;
    }

    /* =========================================================
       WRAPPER
    ========================================================== */

    .gala-wrap {
        z-index: 2;
        position: relative;
    }
</style>

<div class="gala-page">

    {{-- =========================================================
         FONDOS
    ========================================================== --}}
    <div class="backdrop-base"></div>
    <div class="backdrop"></div>


    <div class="gala-wrap">

        {{-- =========================================================
             HEADER / HERO
        ========================================================== --}}
        <header class="hero">

            <img class="logo-badge" src="../images/encuesta/logo-encuesta.png">    

            <div class="eyebrow">
                1991 &mdash; 2026
            </div>

            <h1>
                {{ __('portal.gala.hero.title_line_1') }}<br>
                {{ __('portal.gala.hero.title_line_2') }}
            </h1>

            <p class="hero-sub">
                {{ __('portal.gala.hero.description') }}
            </p>

        </header>


        {{-- =========================================================
             FORMULARIO
        ========================================================== --}}
        <div class="card">

            <form
                id="menuForm"
                novalidate>

                {{-- =================================================
     NOMBRE
================================================== --}}
<div class="field-group">

    <label
        class="field-label"
        for="fullName">

        {{ __('portal.gala.form.full_name.label') }}

    </label>

    <input
        type="text"
        id="fullName"
        name="fullName"
        placeholder="{{ __('portal.gala.form.full_name.placeholder') }}"
        autocomplete="name"
        value="{{ auth()->user()->fullName() }}"
        readonly>

</div>


                {{-- =================================================
                     ALERGIAS
                ================================================== --}}
                <div class="field-group">

                    <label
                        class="field-label"
                        for="allergyNote">

                        {{ __('portal.gala.form.allergy.label') }}

                    </label>

                    <textarea
                        id="allergyNote"
                        name="allergyNote"
                        placeholder="{{ __('portal.gala.form.allergy.placeholder') }}"></textarea>

                    <p class="field-note">
                        {{ __('portal.gala.form.allergy.note') }}
                    </p>

                </div>


                {{-- =================================================
                     ENTRADA
                ================================================== --}}
                <div
                    class="course"
                    data-course="entrada">

                    <div class="course-head">

                        <span class="course-name">
                            {{ __('portal.gala.menu.starter.title') }}
                        </span>

                        <span class="course-rule"></span>

                    </div>


                    <div class="options">

                        {{-- OPCIÓN I --}}
                        <div class="option">

                            <input
                                type="radio"
                                name="entrada"
                                id="entrada-a"
                                value="Ceviche de atún fresco marinado en leche de tigre y maíz tatemado">

                            <label for="entrada-a">

                                <span class="radio-dot"></span>

                                <span class="option-text">

                                    <span class="option-name">

                                        <span class="option-letter">
                                            I.
                                        </span>

                                        {{ __('portal.gala.menu.starter.options.ceviche') }}

                                    </span>

                                </span>

                            </label>

                        </div>


                        {{-- OPCIÓN II --}}
                        <div class="option">

                            <input
                                type="radio"
                                name="entrada"
                                id="entrada-b"
                                value="Bisque de langosta con esencia de pernod y aceite de perejil">

                            <label for="entrada-b">

                                <span class="radio-dot"></span>

                                <span class="option-text">

                                    <span class="option-name">

                                        <span class="option-letter">
                                            II.
                                        </span>

                                        {{ __('portal.gala.menu.starter.options.bisque') }}

                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     PLATO FUERTE
                ================================================== --}}
                <div
                    class="course"
                    data-course="platoFuerte">

                    <div class="course-head">

                        <span class="course-name">
                            {{ __('portal.gala.menu.main_course.title') }}
                        </span>

                        <span class="course-rule"></span>

                    </div>


                    <div class="options">

                        {{-- OPCIÓN I --}}
                        <div class="option">

                            <input
                                type="radio"
                                name="platoFuerte"
                                id="plato-a"
                                value="Filete de res a la plancha, puré de patatas al ajo y romero, verduras de temporada en salsa de vino tinto">

                            <label for="plato-a">

                                <span class="radio-dot"></span>

                                <span class="option-text">

                                    <span class="option-name">

                                        <span class="option-letter">
                                            I.
                                        </span>

                                        {{ __('portal.gala.menu.main_course.options.beef') }}

                                    </span>

                                </span>

                            </label>

                        </div>


                        {{-- OPCIÓN II --}}
                        <div class="option">

                            <input
                                type="radio"
                                name="platoFuerte"
                                id="plato-b"
                                value="Suprema de pargo en hoja de maíz al pastor, arroz salvaje y verduras de la estación">

                            <label for="plato-b">

                                <span class="radio-dot"></span>

                                <span class="option-text">

                                    <span class="option-name">

                                        <span class="option-letter">
                                            II.
                                        </span>

                                        {{ __('portal.gala.menu.main_course.options.snapper') }}

                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     POSTRE
                ================================================== --}}
                <div
                    class="course"
                    data-course="postre">

                    <div class="course-head">

                        <span class="course-name">
                            {{ __('portal.gala.menu.dessert.title') }}
                        </span>

                        <span class="course-rule"></span>

                    </div>


                    <div class="options">

                        {{-- OPCIÓN I --}}
                        <div class="option">

                            <input
                                type="radio"
                                name="postre"
                                id="postre-a"
                                value="Tarta New York de queso con salsa de frutas">

                            <label for="postre-a">

                                <span class="radio-dot"></span>

                                <span class="option-text">

                                    <span class="option-name">

                                        <span class="option-letter">
                                            I.
                                        </span>

                                        {{ __('portal.gala.menu.dessert.options.cheesecake') }}

                                    </span>

                                </span>

                            </label>

                        </div>


                        {{-- OPCIÓN II --}}
                        <div class="option">

                            <input
                                type="radio"
                                name="postre"
                                id="postre-b"
                                value="Mousse de chocolate blanco y oscuro">

                            <label for="postre-b">

                                <span class="radio-dot"></span>

                                <span class="option-text">

                                    <span class="option-name">

                                        <span class="option-letter">
                                            II.
                                        </span>

                                        {{ __('portal.gala.menu.dessert.options.mousse') }}

                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     SUBMIT
                ================================================== --}}
                <div class="submit-row">

                    <button
                        type="submit"
                        class="submit-btn"
                        id="submitBtn"
                        disabled
                        data-default-text="{{ __('portal.gala.form.submit') }}"
                        data-saving-text="{{ __('portal.gala.form.saving') }}">

                        {{ __('portal.gala.form.submit') }}

                    </button>


                    <p
                        class="error-msg"
                        id="errorMsg"
                        data-save-error="{{ __('portal.gala.form.save_error') }}">

                        {{ __('portal.gala.form.error') }}

                    </p>


                    <p class="hint">
                        {{ __('portal.gala.form.hint') }}
                    </p>

                </div>

            </form>


            {{-- =====================================================
                 TICKET / CONFIRMACIÓN
            ====================================================== --}}
            <div
                class="ticket"
                id="ticket">

                <div class="ticket-check">

                    <svg
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        aria-hidden="true">

                        <path
                            d="M4 12.5L9.5 18L20 6"
                            stroke="#024D25"
                            stroke-width="2.6"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>

                    </svg>

                </div>


                <h2>
                    {{ __('portal.gala.confirmation.title') }}
                </h2>


                <p class="ticket-sub">
                    {{ __('portal.gala.confirmation.description') }}
                </p>


                <div class="ticket-row">

                    <span class="k">
                        {{ __('portal.gala.confirmation.name') }}
                    </span>

                    <span
                        class="v"
                        id="t-name">
                    </span>

                </div>


                <div class="ticket-row">

                    <span class="k">
                        {{ __('portal.gala.confirmation.starter') }}
                    </span>

                    <span
                        class="v"
                        id="t-entrada">
                    </span>

                </div>


                <div class="ticket-row">

                    <span class="k">
                        {{ __('portal.gala.confirmation.main_course') }}
                    </span>

                    <span
                        class="v"
                        id="t-plato">
                    </span>

                </div>


                <div class="ticket-row">

                    <span class="k">
                        {{ __('portal.gala.confirmation.dessert') }}
                    </span>

                    <span
                        class="v"
                        id="t-postre">
                    </span>

                </div>


                <div
                    class="ticket-row"
                    id="t-allergy-row"
                    style="display:none;">

                    <span class="k">
                        {{ __('portal.gala.confirmation.allergy') }}
                    </span>

                    <span
                        class="v"
                        id="t-allergy">
                    </span>

                </div>


                <button
                    type="button"
                    class="edit-link"
                    id="editLink">

                    {{ __('portal.gala.confirmation.edit') }}

                </button>

            </div>

        </div>


        {{-- =========================================================
             FOOTER
        ========================================================== --}}
        <!-- <footer>

            <a                class="admin-link"                href="https://docs.google.com/spreadsheets/d/1JjlMs1IsImgym3RIxsubl4tJhY432n6GbwoK5RYLQbo/edit?usp=sharing"
                target="_blank"
                rel="noopener noreferrer">

                {{ __('portal.gala.admin_link') }}

            </a>

        </footer> -->

    </div>

</div>

@endsection
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="page-header mera-page-header">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="header-title-wrapper">
                <span class="header-line"></span>

                <div>
                    <h5 class="mera-title">
                        Dashboard
                    </h5>

                    <p class="mera-subtitle">
                        Bienvenido nuevamente, {{ auth()->user()->name }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MÉTRICAS --}}
<div class="row">

    <div class="col-xl-3 col-md-6">
        <div class="mera-dashboard-card">
            <div class="mera-dashboard-icon mera-blue">
                <i class="fas fa-users"></i>
            </div>

            <div>
                <span>
                    Usuarios
                </span>

                <h3>
                    {{ $usersCount ?? 0 }}
                </h3>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="mera-dashboard-card">
            <div class="mera-dashboard-icon mera-dark">
                <i class="fas fa-id-badge"></i>
            </div>

            <div>
                <span>
                    Roles
                </span>

                <h3>
                    {{ $rolesCount ?? 0 }}
                </h3>
            </div>
        </div>
    </div>
</div>

{{-- ACCESOS RÁPIDOS --}}
<div class="card mera-dashboard-section">
    <div class="card-body">
        <h5 class="mera-section-title">
            Accesos rápidos
        </h5>

        <div class="row">

            <div class="col-md-4">
                <a href="{{ route('users.create') }}"
                    class="mera-shortcut">

                    <i class="fas fa-user-plus"></i>

                    <span>
                        Nuevo usuario
                    </span>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('roles.create') }}"
                    class="mera-shortcut">

                    <i class="fas fa-id-badge"></i>

                    <span>
                        Nuevo rol
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>


@endsection
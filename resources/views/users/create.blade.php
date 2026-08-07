@extends('layouts.app')

@section('title', 'Nuevo Usuario')

@section('content')

<div class="card mera-form-card">

    <div class="card-header mera-form-header">

        <div class="mera-header-icon">
            <i class="fa fa-user-plus"></i>
        </div>

        <div>
            <h5>Crear Usuario</h5>
            <span>Registra un nuevo usuario en el sistema</span>
        </div>

    </div>


    <div class="card-block">

        <form action="{{ route('users.store') }}" method="POST">

            @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

            @endif

            @csrf


            <div class="row">


                {{-- Nombre --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control mera-input"
                            placeholder="Ingrese el nombre"
                            value="{{ old('name') }}"
                            required>

                    </div>

                </div>


                {{-- Apellidos --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Apellido(s)
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            class="form-control mera-input"
                            placeholder="Ingrese apellido(s)"
                            value="{{ old('last_name') }}">

                    </div>

                </div>


                {{-- Email --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Correo Electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control mera-input"
                            placeholder="Ingrese el correo electrónico"
                            value="{{ old('email') }}"
                            required>

                    </div>

                </div>


                {{-- Teléfono --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Teléfono
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control mera-input"
                            placeholder="Ingrese teléfono"
                            value="{{ old('phone') }}">

                    </div>

                </div>


                {{-- País --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            País
                        </label>

                        <input
                            type="text"
                            name="country"
                            class="form-control mera-input"
                            placeholder="Ingrese país"
                            value="{{ old('country') }}">

                    </div>

                </div>


                {{-- Password --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Contraseña
                        </label>

                        <input
                            type="password"
                            name="password"
                            class="form-control mera-input"
                            placeholder="Ingrese la contraseña"
                            required>

                    </div>

                </div>


                {{-- Rol --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Rol
                        </label>

                        <select
                            name="role"
                            class="form-control mera-input"
                            required>


                            @foreach ($roles as $role)

                            <option value="{{ $role->name }}">
                                {{ ucfirst($role->name) }}
                            </option>

                            @endforeach


                        </select>

                    </div>

                </div>


                {{-- Estado --}}
                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Estado
                        </label>


                        <select
                            name="status_id"
                            class="form-control mera-input"
                            required>


                            @foreach ($statuses as $status)

                            <option value="{{ $status->id }}">
                                {{ $status->name }}
                            </option>

                            @endforeach


                        </select>

                    </div>

                </div>


            </div>



            <div class="mera-form-actions">


                <button type="submit" class="btn mera-btn-save">

                    <i class="fas fa-user-plus"></i>
                    Crear Usuario

                </button>



                <a href="{{ route('users.index') }}"
                    class="btn mera-btn-cancel">

                    <i class="fas fa-times"></i>
                    Cancelar

                </a>


            </div>


        </form>

    </div>

</div>


@endsection
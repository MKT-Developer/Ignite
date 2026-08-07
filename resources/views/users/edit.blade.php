@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')

<div class="card mera-form-card">


    <div class="card-header mera-form-header">

        <div class="mera-header-icon">
            <i class="fa fa-user"></i>
        </div>

        <div>
            <h5>Editar Usuario</h5>
            <span>Actualiza la información del usuario seleccionado</span>
        </div>

    </div>


    <div class="card-block">

        <form action="{{ route('users.update', $user) }}" method="POST">

            @csrf
            @method('PUT')


            <div class="row">


                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Nombre
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control mera-input"
                            value="{{ old('name', $user->name) }}"
                            required>

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Apellido(s)
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            class="form-control mera-input"
                            value="{{ old('last_name', $user->last_name) }}">

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Correo Electrónico
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control mera-input"
                            value="{{ old('email', $user->email) }}"
                            required>

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Teléfono
                        </label>

                        <input
                            type="text"
                            name="phone"
                            class="form-control mera-input"
                            value="{{ old('phone', $user->phone) }}">

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            País
                        </label>

                        <input
                            type="text"
                            name="country"
                            class="form-control mera-input"
                            value="{{ old('country', $user->country) }}">

                    </div>

                </div>



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

                            <option
                                value="{{ $status->id }}"
                                {{ $user->status_id == $status->id ? 'selected' : '' }}>

                                {{ $status->name }}

                            </option>

                            @endforeach


                        </select>

                    </div>

                </div>



                <div class="col-md-6">

                    <div class="form-group mera-form-group">

                        <label>
                            Nueva Contraseña
                            <small>(opcional)</small>
                        </label>


                        <input
                            type="password"
                            name="password"
                            class="form-control mera-input"
                            placeholder="Ingrese una nueva contraseña">

                    </div>

                </div>



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

                            <option
                                value="{{ $role->name }}"
                                {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>

                                {{ $role->name }}

                            </option>

                            @endforeach


                        </select>

                    </div>

                </div>


            </div>



            <div class="mera-form-actions">


                <button type="submit" class="btn mera-btn-save">

                    <i class="fas fa-save"></i>
                    Actualizar

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
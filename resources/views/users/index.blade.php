@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')


<div class="page-header mera-page-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="header-title-wrapper">

                <span class="header-line"></span>

                <div>
                    <h5 class="mera-title">
                        Usuarios
                    </h5>

                    <p class="mera-subtitle">
                        Administración y gestión de usuarios del sistema
                    </p>
                </div>
            </div>

            @if(session('success'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal(
                        "¡Éxito!",
                        "{{ session('success') }}",
                        "success"
                    );
                });
            </script>

            @elseif(session('error'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal(
                        "¡Error!",
                        "{{ session('error') }}",
                        "error"
                    );
                });
            </script>
            @endif
        </div>

        <div class="col-md-4 text-right"> <a href="{{ route('users.create') }}" class="btn mera-btn-primary">
                <span class="mera-btn-icon">
                    +
                </span>

                Nuevo Usuario

            </a>
        </div>
    </div>
</div>

{{-- FILTROS --}}
<div class="wrapper-filter-list mt-4">
    <form method="GET"
        action="{{ route('users.index') }}">


        <div class="row">



            <div class="col-md-4">


                <label>
                    Buscar
                </label>


                <input type="text"
                    name="search"
                    class="form-control mera-input"
                    value="{{ request('search') }}"
                    placeholder="Nombre, correo o empleado">


            </div>




            <div class="col-md-3">


                <label>
                    País
                </label>


                <select name="country"
                    class="form-control mera-input">


                    <option value="">
                        Todos
                    </option>


                    @foreach($countries as $country)


                    <option value="{{ $country }}"
                        @if(request('country')==$country)
                        selected
                        @endif>

                        {{ $country }}

                    </option>


                    @endforeach


                </select>


            </div>





            <div class="col-md-3">


                <label>
                    Estado
                </label>


                <select name="status_id"
                    class="form-control mera-input">


                    <option value="">
                        Todos
                    </option>


                    @foreach($statuses as $status)


                    <option value="{{ $status->id }}"
                        @if(request('status_id')==$status->id)
                        selected
                        @endif
                        >

                        {{ $status->name }}

                    </option>


                    @endforeach


                </select>


            </div>




            <div class="col-md-2 d-flex align-items-end">


                <button class="btn mera-btn-primary w-100">


                    <i class="fa fa-search"></i>


                    Filtrar


                </button>


            </div>



        </div>





        <div class="row mt-3">



            <div class="col-md-10">


                <label>
                    Rol
                </label>


                <select name="role"
                    class="form-control mera-input">


                    <option value="">
                        Todos
                    </option>



                    @foreach($roles as $role)


                    <option value="{{ $role->name }}"
                        @if(request('role')==$role->name)
                        selected
                        @endif
                        >

                        {{ ucfirst($role->name) }}

                    </option>


                    @endforeach



                </select>



            </div>




            <div class="col-md-2 d-flex align-items-end">


                <a href="{{ route('users.index') }}"
                    class="btn btn-secondary w-100">


                    Limpiar


                </a>


            </div>


        </div>



    </form>


</div>







{{-- TABLA --}}



<div class="card mera-table-card mt-4">



    <div class="card-body p-0">


        <div class="table-responsive">



            <table class="table mera-table mb-0">



                <thead>


                    <tr>


                        <th>
                            Empleado
                        </th>


                        <th>
                            Usuario
                        </th>


                        <th>
                            Correo
                        </th>


                        <th>
                            País
                        </th>


                        <th>
                            Estado
                        </th>


                        <th>
                            Rol
                        </th>


                        <th class="text-center">
                            Acciones
                        </th>


                    </tr>


                </thead>




                <tbody>



                    @forelse($users as $user)



                    <tr>



                        <td>

                            {{ $user->employee_number ?? 'N/A' }}

                        </td>




                        <td>


                            <div class="user-name">


                                {{ $user->fullName() }}


                            </div>


                        </td>




                        <td>


                            <span class="user-email">


                                {{ $user->email }}


                            </span>


                        </td>





                        <td>


                            {{ $user->country ?? 'Sin asignar' }}


                        </td>





                        <td>


                            @if($user->isActive())


                            <span class="mera-badge">

                                Activo

                            </span>


                            @else


                            <span class="mera-badge">

                                Inactivo

                            </span>


                            @endif


                        </td>





                        <td>



                            @forelse($user->roles as $role)



                            <span class="mera-badge">


                                {{ ucfirst($role->name) }}


                            </span>



                            @empty


                            <span class="text-muted">

                                Sin rol

                            </span>



                            @endforelse



                        </td>






                        <td class="text-center">





                            <a href="{{ route('users.edit',$user) }}"
                                class="mera-action-btn mera-edit-btn">


                                <i class="fas fa-pencil-alt"></i>


                            </a>






                            @if(!$user->hasRole('super admin'))



                            <form action="{{ route('users.destroy',$user) }}"
                                method="POST"
                                style="display:inline;"
                                id="delete-form-{{ $user->id }}">


                                @csrf

                                @method('DELETE')



                                <button type="button"
                                    class="mera-action-btn mera-delete-btn"
                                    onclick="confirmDelete({{ $user->id }})">


                                    <i class="fa fa-trash"></i>


                                </button>



                            </form>



                            @endif




                        </td>



                    </tr>




                    @empty



                    <tr>


                        <td colspan="7"
                            class="text-center">


                            No hay usuarios registrados.


                        </td>


                    </tr>



                    @endforelse




                </tbody>



            </table>




        </div>


    </div>






    @if($users->hasPages())


    <div class="card-footer">


        {{ $users->links() }}


    </div>


    @endif




</div>






<script>
    function confirmDelete(userId) {


        swal({

                title: "¿Estás seguro?",

                text: "Esta acción no se puede deshacer.",

                icon: "warning",

                buttons: [
                    "Cancelar",
                    "Eliminar"
                ],

                dangerMode: true,


            })


            .then((willDelete) => {


                if (willDelete) {

                    document
                        .getElementById(`delete-form-${userId}`)
                        .submit();


                }


            });



    }
</script>



@endsection
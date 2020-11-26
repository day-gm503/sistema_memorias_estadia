@extends('layouts.main')

@section('contenido')
<div class="d-sm-flex aling-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800">Usuarios</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm" data-toggle="modal"
        data-target="#modalAgregar">
        <i class="fas fa-user fa-sm text-white-50"></i>Agregar Usuario
    </a>
</div>

<div class="row">
    @if($message = Session::get('Listo'))
    <div class="col-12 alert alert-success alert-dismissable fade show" role="alert">
        <h5>Exitoso:</h5>
        <ul>
            <span>{{ $message }}</span>
        </ul>
    </div>
    @endif
</div>

<table class="table col-12">
    <thead>
        <tr>
            <td>Id</td>
            <td>Nombre</td>
            <td>Apellido Paterno</td>
            <td>Apellido Materno</td>
            <td>Genero</td>
            <td>Fecha Naciemiento</td>
            <td>Telefono</td>
            <td>Correo</td>
            <td>Usuario</td>
            <td>Perfil</td>
            <td>&nbsp;</td>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id}}</td>
            <td>{{ $usuario->nombre}}</td>
            <td>{{ $usuario->apellido_paterno}}</td>
            <td>{{ $usuario->apellido_materno}}</td>
            <td>{{ $usuario->genero}}</td>
            <td>{{ $usuario->fecha_nacimiento}}</td>
            <td>{{ $usuario->telefono}}</td>
            <td>{{ $usuario->email}}</td>
            <td>{{ $usuario->usuario}}</td>
            <td>{{ $usuario->perfil}}</td>
            <td>
                <button class="btn btn-round btnEliminar" data-id="{{ $usuario->id }}" data-toggle="modal"
                    data-target="#modalEliminar"> <i class="fa fa-trash"></i></button>
                <form action="{{url('/admin/usuarios',['id'=>$usuario->id])}}" method="post"
                    id="formEli_{{ $usuario->id}}">
                    @csrf
                    <input type="hidden" name="id" value="{{$usuario->id}}">
                    <input type="hidden" name="_method" value="delete">
                </form>
            </td>
            <td>
                <button class="btn btn-round btnEditar"
                    data-id="{{$usuario->id}}"
                    data-nombre="{{$usuario->nombre}}"
                    data-apellido_paterno="{{$usuario->apellido_paterno}}"
                    data-apellido_Materno="{{$usuario->apellido_materno}}"
                    data-genero="{{$usuario->genero}}"
                    data-fecha_nacimiento="{{$usuario->fecha_nacimiento}}"
                    data-telefono="{{$usuario->telefono}}"
                    data-email="{{$usuario->email}}"
                    data-usuario="{{$usuario->usuario}}"
                    data-contrasena="{{$usuario->contrasena}}"
                    data-perfil="{{$usuario->perfil}}" data-toggle="modal" data-target="#modalEditar">
                    <i class="fa fa-edit"></i></button>
            </td>
            @endforeach
        </tr>
    </tbody>
</table>

<!-- Modal agregar usuario-->
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Registrar nuevo usuario</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/usuarios" method="post">
                @csrf
                <div class="modal-body">
                    @if($message = Session::get('ErrorInsert'))
                    <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                        <h5>Errores:</h5>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre"
                            value="{{old('nombre')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="apellido_paterno" placeholder="Apellido paterno"
                            value="{{old('apellido_paterno')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="apellido_materno" placeholder="Apellido materno"
                            value="{{old('apellido_Materno')}}">
                    </div>
                    <div class="form-group">
                        <select name="genero" class="form-control" value="{{old('genero')}}">
                            <option value="">Seleccione genero</option>
                            <option value="Femenino" class="circle" data-icon="img/">Femenino</option>
                            <option value="Masculino">Masculino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>Fecha de nacimimento</h6>
                        <input type="date" class="datepicker form-control" name="fecha_nacimiento">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="telefono" placeholder="Telefono"
                            value="{{old('telefono')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Correo"
                            value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario"
                            value="{{old('usuario')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="contrasena" placeholder="Contraseña"
                            value="{{old('contrasena')}}">
                    </div>
                    <div class="form-group">
                        <select name="perfil" class="form-control">
                            <option value="">Seleccione usuario</option>
                            <option value="Administrador de biblioteca">Administrador de biblioteca</option>
                            <option value="Administrador de sistema">Administrador de sistema</option>
                            <option value="Alumno">Alumno</option>
                            <option value="Asistente administrativo">Asistente administrativo</option>
                            <option value="Director de carrera">Director de carrera</option>
                            <option value="Tutor">Tutor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal eliminar usuario-->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Eliminar usuario</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{ method_field('delete')}}
            @csrf
            <div class="modal-body">
                <h5>¿Desea eliminar el usuario?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger btnModalEliminar">Eliminar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!--Modal modificar-->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">Modificar usuario</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/admin/usuarios/edit" method="post">
            
                @csrf
                <div class="modal-body">
                    @if($message = Session::get('ErrorInsert'))
                    <div class="col-12 alert alert-danger alert-dismissable fade show" role="alert">
                        <h5>Errores:</h5>
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <input type="hidden" name="id" id="idEdit">
                    <div class="form-group">
                        <input type="text" class="form-control" name="nombre" placeholder="Nombre" value="{{ old('nombre') }}" id="nombreEditar">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="apellido_paterno" placeholder="Apellido paterno" value="{{old('apellido_paterno')}}" id="appEdit">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="apellido_materno" placeholder="Apellido materno" value="{{old('apellido_materno')}}" id="apmEdit">
                    </div>
                    <div class="form-group">
                        <select name="genero" class="form-control" id="generoEdit">
                            <option value="">Seleccione genero</option>
                            <option value="Femenino">Femenino</option>
                            <option value="Masculino">Masculino</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <h6>Fecha de nacimimento</h6>
                        <input type="date" class="datepicker form-control" name="fecha_nacimiento" id="fechanEdit">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="telefono" placeholder="Telefono" value="{{old('telefono')}}" id="telefonoEdit">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Correo"
                            value="{{old('email')}}" id="emailEdit">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="usuario" placeholder="Usuario"
                            value="{{old('usuario')}}" id="usuarioEdit">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="contrasena" placeholder="Contraseña"
                            value="">
                    </div>
                    <div class="form-group">
                        <select name="perfil" class="form-control" id="perfilEdit">
                            <option value="">Seleccione usuario</option>
                            <option value="Administrador de biblioteca">Administrador de biblioteca</option>
                            <option value="Administrador de sistema">Administrador de sistema</option>
                            <option value="Alumno">Alumno</option>
                            <option value="Asistente administrativo">Asistente administrativo</option>
                            <option value="Director de carrera">Director de carrera</option>
                            <option value="Tutor">Tutor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{ $usuarios->links() }}
@endsection

@section('scripts')
<script>
var idEliminar = 0;
$(document).ready(function() {
    @if($message = Session::get('ErrorInsert'))
        $('#modalAgregar').modal('show');
    @endif
    $(".btnEliminar").click(function(){
        idEliminar = $(this).data('id');
    });
    $(".btnModalEliminar").click(function(){
        $("#formEli_" + idEliminar).submit();
    });
    $(".btnEditar").click(function(){
        $("#idEdit").val($(this).data('id'));
        $("#nombreEditar").val($(this).data('nombre'));
        $("#appEdit").val($(this).data('apellido_paterno'));
        $("#apmEdit").val($(this).data('apellido_materno'));
        $("#generoEdit").val($(this).data('genero'));
        $("#fechanEdit").val($(this).data('fecha_nacimiento'));
        $("#telefonoEdit").val($(this).data('telefono'));
        $("#emailEdit").val($(this).data('email'));
        $("#usuarioEdit").val($(this).data('usuario'));
        $("#perfilEdit").val($(this).data('perfil'));
    });
});
</script>
@endsection
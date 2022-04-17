@extends('home')

@section('contenido')

<div class="container w-25 border p-4 mt-5">
    <form action=" {{ route('categorias.update',['categoria' => $categoria->id]) }} " method="POST">
        <h5 class="bg-light text-center">Actualizar Categoría</h5>
        @method('PATCH')
        @csrf
        <!-- Cross-site request forgery -->

        <!-- Mostrar alerta si es correcto o incorrecto el llenado de campos -->
        @if (session('success'))
        <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif

        @error('nombre')
        <h6 class="alert alert-danger">{{ $message }}</h6>
        @enderror

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" required class="form-control" value="{{ $categoria->nombre }}">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="color" name="color" class="form-control" value="{{ $categoria->color }}">
        </div>
        <button type="submit" class="btn btn-success w-100" title="Enviar">Actualizar categoria</button>
    </form>

    <div>
        <!--Consultar lista de Tareas-->
        @if ($categoria->tareas->count() > 0)
        @foreach ($categoria->tareas as $tarea)
        <div class="row py-1 mt-3">
            <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route('tarea-show', ['id' => $tarea->id]) }}">{{$tarea->titulo}}</a>
            </div>

            <div class="col-md-3 d-flex justify-content-end">
                <!-- Modal Button -->
                <div class="col-md-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$tarea->id}}" title="Eliminar tarea {{$tarea->id}}">Eliminar</button>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modal-{{$tarea->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">¿Eliminar Tarea?</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estas seguro de querer eliminar la tarea de <b style="color:red;">{{$tarea->titulo}}</b> ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('tarea-destroy',[$tarea->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        @endforeach
        @else
        <p class="text-center mt-3">
            <b>No hay tareas para esta categoria.</b>
        </p>
        @endif
    </div>
</div>

@endsection
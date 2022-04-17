@extends('home')

@section('contenido')

<div class="container w-25 border p-4 mt-5">
    <form action=" {{ route('tareas') }} " method="POST">
         <h5 class="bg-light text-center">Agregar Tarea</h5>
        @csrf
        <!-- Cross-site request forgery -->

        <!-- Mostrar alerta si es correcto o incorrecto el llenado de campos -->
        @if (session('success'))
        <h6 class="alert alert-success text-center" style="color:black;"><b>{{ session('success') }}</b></h6>
        @endif

        @error('titulo')
        <h6 class="alert alert-danger text-center" style="color:black;"><b>{{ $message }}</b></h6>
        @enderror

        <div class="mb-3">
            <label for="titulo" class="form-label">Titulo</label>
            <input name="titulo" type="text" required class="form-control" placeholder="Titulo de Tarea">
        </div>
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria de la tarea</label>
            <select name="categoria_id" class="form-select">
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100" title="Enviar">Crear nueva Tarea</button>
    </form>

    <div>
        @foreach ($tareas as $tarea)
        <div class="row py-1 mt-3 bg-light">
            <div class="col-md-9 d-flex align-items-center">
                <a href="{{ route( 'tarea-show' , [ 'id' => $tarea->id ] ) }}">{{$tarea->titulo}}</a>
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
    </div>

</div>
@endsection
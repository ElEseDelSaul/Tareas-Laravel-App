@extends('home')

@section('contenido')

<div class="container w-25 border p-4 mt-5">
    <form action=" {{ route('categorias.store') }} " method="POST">
    <h5 class="bg-light text-center">Agregar Categoría</h5>
        @csrf
        <!-- Cross-site request forgery -->

        <!-- Mostrar alerta si es correcto o incorrecto el llenado de campos -->
        @if (session('success'))
        <h6 class="alert alert-success text-center" style="color:black;"><b>{{ session('success') }}</b></h6>
        @endif

        @error('nombre')
        <h6 class="alert alert-danger  text-center" style="color:black;"><b>">{{ $message }}</b></h6>
        @enderror

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input name="nombre" type="text" required class="form-control" placeholder="Nombre de Categoria">
        </div>
        <div class="mb-3">
            <label for="color" class="form-label">Color</label>
            <input type="color" name="color" class="form-control">
        </div>
        <button type="submit" class="btn btn-success w-100" title="Enviar">Crear nueva categoria</button>
    </form>

    <div>
        @foreach ($categorias as $categoria)
        <div class="row py-1  mt-3 bg-light">
            <div class="col-md-9 d-flex align-items-center justify-content-evenly">
                <a href="{{ route('categorias.show',['categoria' => $categoria->id]) }}">
                    <span class="container" style="background-color: {{ $categoria->color }} "></span> {{$categoria->nombre}}
                </a>
            </div>

            <!-- Modal Button -->
            <div class="col-md-3 d-flex justify-content-end">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{$categoria->id}}" title="Eliminar categoria {{$categoria->id}}">Eliminar</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{$categoria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">¿Eliminar categoria?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Estas seguro de querer eliminar la categoria de <b style="color:{{$categoria->color}};">{{$categoria->nombre}}</b> ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('categorias.destroy',['categoria' => $categoria->id ]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        @endforeach
    </div>

</div>


@endsection
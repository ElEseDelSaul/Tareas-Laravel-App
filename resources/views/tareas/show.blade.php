@extends('home')

@section('contenido')
<div class="container w-25 border p-4 mt-5">

    <form action=" {{ route('tarea-update' , ['id' => $tarea -> id]) }} " method="POST">
    <h5 class="bg-light text-center">Actualizar Tarea</h5>
        @method('PATCH')
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
            <input name="titulo" type="text" required class="form-control" value="{{ $tarea -> titulo}}">
        </div>
        <!-- {{$tarea}} -->
        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria de la tarea</label>
            <select name="categoria_id" class="form-select">
                <option value="{{$catego->id}}" selected>{{$catego->nombre}}</option>
                @foreach ($categorias as $categoria)
                    @if ($categoria->nombre == $catego->nombre)
                        
                    @else
                        <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success w-100" title="Enviar">Actualizar</button>
    </form>
</div>
@endsection
@extends('layout.layout')
@section("body")

<div class="d-flex justify-content-end">
<!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsert">
    Añadir Producto
</button>
</div>
<div class="table-responsive mt-2">
    <table class="table" id="tb-productos">
      <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Contenido</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Opciones</th>
        </tr>
      </thead>
@foreach ($productos as $producto )
<tr>
    <td>{{$producto->nombre}}</td>
    <td>{{$producto->descripcion}}</td>
    <td>{{$producto->contenido}}</td>
    <td>{{$producto->precio}}</td>
    <td>{{$producto->cantidad}}</td>
    <td class="d-flex justify-content-evenly">
        <form method="POST" action="{{ url("productos/{$producto->id}") }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mx-1">Eliminar</button>
      </form>
      <button type="button" class="btn btn-sm btn-success btn-update mx-1" data-object='@json($producto)' data-toggle="modal" data-target="#modalUpdate">
        Actualizar
    </button>
    </td>
</tr>

@endforeach
    </table>
  </div>
<div class="modal" id="modalInsert">
    <form role="form" action="{{ route('productos.post') }}" method="post" enctype="multipart/form">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                <label for="nombre">Nombre del producto:</label>
                <input type="text" class="form-control" placeholder="Coca Cola" id="nombre" name="nombre" value="{{old('nombre')}}">
                @if($errors->first('nombre'))
    				        <p class="text-danger">{{$errors->first('nombre')}}</p>
    				    @endif

                <label for="descripcion">Descripción:</label>
                <textarea type="text" class="form-control"  id="descripcion" name="descripcion" value="{{old('descripcion')}}"></textarea>
                @if($errors->first('descripcion'))
    				        <p class="text-danger">{{$errors->first('descripcion')}}</p>
    				    @endif

                <label for="precio">Precio:</label>
                <input type="number" class="form-control" placeholder="15" step="0.01"  id="precio" name="precio" value="{{old('precio')}}">
                @if($errors->first('precio'))
    				        <p class="text-danger">{{$errors->first('precio')}}</p>
    				    @endif

                <label for="Contenido">Contenido:</label>
                <input type="text" class="form-control" placeholder="" id="contenido" name="contenido" value="{{old('contenido')}}">
                @if($errors->first('contenido'))
    				        <p class="text-danger">{{$errors->first('contenido')}}</p>
    				    @endif

                <label for="cantidad">Cantidad:</label>
                <input type="number" class="form-control" placeholder="15"  id="cantidad" name="cantidad" value="{{old('cantidad')}}">
                @if($errors->first('cantidad'))
    				        <p class="text-danger">{{$errors->first('cantidad')}}</p>
    				    @endif

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
        @csrf
    </form>
      </div>
    </div>
  </div>

  <div class="modal" id="modalUpdate">
    <form action="{{ route('productos.put') }}" method="post" id="form-update">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Actualizar producto</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="id" id="id">

            <label for="nombre">Nombre del producto:</label>
            <input type="text" class="form-control" placeholder="Coca Cola" id="nombre" name="nombre" value="{{old('nombre')}}">
            @if($errors->first('nombre'))
                <p class="text-danger">{{$errors->first('nombre')}}</p>
            @endif

            <label for="descripcion">Descripción:</label>
            <textarea type="text" class="form-control"  id="descripcion" name="descripcion" value="{{old('descripcion')}}"></textarea>
            @if($errors->first('descripcion'))
                <p class="text-danger">{{$errors->first('descripcion')}}</p>
            @endif

            <label for="precio">Precio:</label>
            <input type="number" class="form-control" placeholder="15" step="0.01"  id="precio" name="precio" value="{{old('precio')}}">
            @if($errors->first('precio'))
                <p class="text-danger">{{$errors->first('precio')}}</p>
            @endif

            <label for="Contenido">Contenido:</label>
            <input type="text" class="form-control" placeholder="" id="contenido" name="contenido" value="{{old('contenido')}}">
            @if($errors->first('contenido'))
                <p class="text-danger">{{$errors->first('contenido')}}</p>
            @endif

            <label for="cantidad">Cantidad:</label>
            <input type="number" class="form-control" placeholder="15"  id="cantidad" name="cantidad" value="{{old('cantidad')}}">
            @if($errors->first('cantidad'))
                <p class="text-danger">{{$errors->first('cantidad')}}</p>
            @endif


            </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Aceptar</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        </div>
        @csrf
        @method('PUT')
    </form>
      </div>
    </div>
  </div>

  @endsection
@section('Scripts')
<script src="{{asset('Scripts/Productos/producto-1.0.js')}}"></script>

{{-- show modal errors --}}
@if(session('message') === 'updated' && $errors->any())
    <script>
        $('#modalUpdate').modal('show');
    </script>
    @elseif(session('message') === 'created' && $errors->any())
    <script>
        $('#modalInsert').modal('show');
    </script>
    @endif
<? } ?>
{{-- end modal errors --}}


@endsection

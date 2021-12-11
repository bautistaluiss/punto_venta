@extends('layout.layout')
@section("body")

<div class="d-flex justify-content-start">
    <h4>Cliente: {{session('cliente')->nombre}}</h2>
</div>
{{--  <div class="d-flex justify-content-end"> --}}
<!-- Button to Open the Modal -->

{{-- <form method="POST" action="{{ route('pedidos.post') }}"> --}}
  {{--  @csrf --}}
  {{-- <input type="hidden" name="id" value="{{$id}}"/> --}}
  {{--  <button type="submit" class="btn btn-sm btn-primary mx-1"> Añadir pedido</button> --}}

    <div class="d-flex justify-content-end">
    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalInsert">
        Añadir Pedido
    </button>
    </div>



{{--   </form> --}}
{{-- </div> --}}
<div class="table-responsive mt-2">

    <table class="table" id="tb-pedidos">
      <thead>
        <tr>
            <th>ID</th>
            <th>Pedido de</th>
            <th>Estatus</th>
            <th>Fecha de Creación</th>
            <th>Fecha de Envio</th>
            <th>Opciones</th>
        </tr>
      </thead>
@foreach ($pedidos as $pedido )
<tr>
    <td>{{$pedido->id}}</td>
    <td>{{$pedido->cliente_id}}</td>
    <td>{{$pedido->estadopedido}}</td>
    <td>{{$pedido->fechapedido}}</td>
    <td>{{$pedido->fechaenvio}}</td>
    <td class="d-flex justify-content-evenly">
        <form method="POST" action="{{ url("pedidos/{$pedido->id}") }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger mx-1">Eliminar</button>
      </form>
      <form method="POST" action="{{ url("/pedidos/enviado/{$pedido->id}") }}">
        @csrf
        @method('Put')
        <button type="submit" class="btn btn-sm btn-success mx-1">Marcar Envio</button>
      </form>
      <a href="{{url("detallePedido/{$pedido->id}")}}" class="btn btn-sm btn-primary">Detalle</a>
    </td>
</tr>

@endforeach
    </table>
  </div>

  <div class="modal" id="modalInsert">
    <form role="form" action="{{ route('pedidos.post') }}" method="POST" enctype="multipart/form">
      {{-- <form role="form" action="{{ route('productos.post') }}" method="post" enctype="multipart/form"> --}}
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nuevo pedido</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
                  <h4>Pedido para: {{session('cliente')->nombre}}</h2>
                    <br>

                  <input type="hidden" name="id" value="{{$id}}"/>

                  <label for="nombre">Fecha de envio:</label>
                  <input type="date" class="form-control" id="fechaenvio" name="fechaenvio" value="{{old('fechaenvio')}}">
                  @if($errors->first('fechaenvio'))
      				        <p class="text-danger">{{$errors->first('fechaenvio')}}</p>
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


  @endsection
@section('Scripts')
<script src="{{asset('Scripts/pedido/pedido-1.0.js')}}"></script>

@if($errors->any())
  <script>
    $('#modalInsert').modal('show');
  </script>
  @endif

@endsection

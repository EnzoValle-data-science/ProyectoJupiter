@extends('layouts.app')


@section('content')
<div class='container my-4 '>
    <h1>Bienvenido {{auth()->user()->name}}</h1>
    <h2>Seleccione alguna de las siguientes acciones:</h2>


    @error('eliminar')               
        <div class="alert alert-danger" role="alert">
        La Unidad de medida es obligatoria.
        </div>
    @enderror 

    @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
    <div class="d-inline-flex p-2">
        <a href="/Producto/create" class="btn btn-outline-primary">Agregar Producto</a>
    </div>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Gasto Total</th>
            <th scope="col">Valor Actual</th>
            <th scope="col">Valor Estimado por unidad</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        @foreach ($Producto as $item)
            <tbody>
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->nombre}}</td>
                <td>{{$item->descripcion}}</td>
                @if ( $item->unidad_medida == "Kg/g")
                <td>{{$item->cantidad}} g</td>
                @endif
                @if ( $item->unidad_medida == "L/ml" )
                <td>{{$item->cantidad}} ml</td>
                @endif
                
                <td>${{$item->valor}}</td>

                <td>${{$item->valor_actual}}</td>

                @if ( $item->unidad_medida == "Kg/g")
                <td>Valor gramo ${{$item->valor_unitario}}</td>
                @endif
                @if ( $item->unidad_medida == "L/ml" )
                <td>Valor mililitro ${{$item->valor_unitario}}</td>
                @endif

                
                <td>



                    <a href="{{route('Producto.edit',$item)}}" class= "btn btn-outline-primary btn-sm ",$item>Modificar</a>

                    <!-- boton eliminar con pop up -->
                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Eliminar</button>
                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Estas seguro que quieres eliminar el producto?</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <h6>Recuerda que no deben existir “Entradas” o “Compras” asociadas</h6>
                                    <form action="{{route('Producto.destroy',$item)}}" class="d-inline " method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger btn-sm ">Eliminar!</button>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->

                    
                    
                    
                </td>

            </tr>
            </tbody>
    
        @endforeach
    </table>


   
</div>
@endsection
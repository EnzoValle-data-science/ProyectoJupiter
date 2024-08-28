@extends('layouts.app')

@section('content')

<div class='container my-4 '>
    <h1>Bienvenido {{auth()->user()->name}}</h1>
    <h2>Seleccione alguna de las siguientes acciones:</h2>

    <div class="d-inline-flex p-2">
        <a href="/Receta/create" class="btn btn-outline-primary">Agregar Receta</a>
    </div>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Categoría De Receta</th>

            <th scope="col">Rendimiento de la Receta</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>

        @foreach ($Receta as $item)
            <tbody>
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->nombre}}</td>
                <td>{{$item->categoria_receta}}</td>

                <td>
                    <!-- boton eliminar con pop up -->
                    <button type="button" class="btn btn-outline-dark btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm">Ver Info</button>
                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Informacion</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                        <h4>Rendimiento de la Receta</h4>
                                        <h6>Numero de porciones: {{$item->numero_porciones}}</h6>
                                        <h6>unidad de la porción: {{$item->unidad_porcion}}</h6>
                                        <h6>Cantidad de porciones: {{$item->cantidad_porcion}}</h6>      
                                        <h4>Costo</h4>
                                        <h6>Costo por porción: {{$item->costo_porcion}}$</h6>
                                        <h6>Costo por receta: {{$item->costo_receta}}$</h6>  
                                        <h4>Venta</h4>
                                        <h6>Precio venta porción: {{$item->precio_porcion}}$</h6>
                                        <h6>$ Utilidad por porción: {{$item->utilidad_porcion}}$</h6>
                                        <h6>% Margen de utilidad por porción: {{$item->margen_utilidad_porcion}}%</h6>      

                                </div>
                            </div>
                        </div>
                    </div>
                    <!---->
                </td>

                <td>
                    <a href="{{route('Receta.show',$item)}}" class= "btn btn-outline-primary btn-sm ">Agregar Productos</a>

                    <form action="{{route('Receta.destroy',$item)}}" class="d-inline " method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm ">Eliminar</button>
                    </form> 
                </td>

        @endforeach
        
    </table>
</div>

@endsection
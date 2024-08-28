@extends('layouts.app')

@section('content')

<div class='container my-4 '>
    <h1>Bienvenido {{auth()->user()->name}}</h1>
    <h2>Seleccione alguna de las siguientes acciones:</h2>

    <div class="d-inline-flex p-2">
        <a href="/Entrada/create" class="btn btn-outline-primary">Generar Nueva Entrada</a>
    </div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Producto</th>
            <th scope="col">Descripción</th>
            <th scope="col">Cantidad Agregada</th>
            <th scope="col">Valor</th>
            <th scope="col">Autor Entrada</th>
            <th scope="col">Fecha Entrada</th>
            <th scope="col">Acciones</th>   
          </tr>
        </thead>
        @foreach ($Entradas as $item)
            <tbody>
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td>{{$item->nombre_producto}}</td>
                <td>{{$item->descripcion}}</td>
                <td>{{$item->cantidad}} {{$item->unidad_medida}}</td>
                <td>${{$item->valor}}</td>
                <td>{{$item->autor}}</td>
                <td>{{$item->created_at}}</td>
                <td>
                    <form action="{{route('Entrada.destroy',$item,$item->id_producto)}}" class="d-inline " method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm ">Eliminar</button>
                    </form> 

                </td>
            </tr>
            </tbody>
    
        @endforeach
    </table>
</div>

    
@endsection








<!-- Comentario abajo



--->
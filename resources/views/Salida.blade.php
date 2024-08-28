@extends('layouts.app')

@section('content')
    <div class='container my-4 '>
        <h1>Bienvenido {{auth()->user()->name}}</h1>
        <h2>Seleccione alguna de las siguientes acciones:</h2>

        <div class="card my-4">
            <form method="POST" action="/Salida">         <!--Al ser el metodo post se detecta automaticamente que se llama a la funcion store --> 
            @csrf
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Generar salida</span>
                    
                </div>
                <div class="card-body">


                    @error('id_receta')    
                    <div class="alert alert-danger" role="alert">
                        Seleccione una Receta valida.
                    </div>
                    @enderror
                    @error('cantidad_recetas')        
                        <div class="alert alert-danger" role="alert">
                        Debe ingresar una cantidad de recetas utilizadas.
                        </div>
                    @enderror 
                    @error('cantidad_porciones')                
                        <div class="alert alert-danger" role="alert">
                        Debe ingresar una cantidad de porciones utilizadas.
                        </div>
                    @enderror  
                    
                    
                    @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @endif

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <label class="input-group-text" for="id_producto">Recetas</label>
                        </div>

                        <select class="custom-select" id="id_receta" name="id_receta">
                        <option disabled selected value>. . .</option>
                        @foreach ($Receta as $RecetaItem)
                            <option  value="{{$RecetaItem->id}}">{{$RecetaItem->nombre}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Ventas</span>
                        <input type="text" aria-label="First name" class="form-control" name="cantidad_recetas" placeholder="Cantidad Recetas Utilizadas">
                        <input type="text" aria-label="First name" class="form-control" name="cantidad_porciones" placeholder="Cantidad porciones Utilizadas">
                    </div>
                    
                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Receta</th>
                <th scope="col">Cantidad Recetas Utilizadas</th>

                <th scope="col">Cantidad porciones Utilizadas</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>

            @foreach ($Salida as $item)
                <tbody>
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->nombre_receta}}</td>
                    <td>{{$item->cantidad_recetas}}</td>
                    <td>{{$item->cantidad_porciones}}</td>


                    <td>
                        <form action="{{route('Salida.destroy',$item)}}" class="d-inline " method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm ">Eliminar</button>
                        </form> 
                    </td>

            @endforeach
            
        </table>
    </div>
@endsection
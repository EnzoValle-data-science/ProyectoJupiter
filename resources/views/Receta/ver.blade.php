@extends('layouts.app')
@section('content')

<!--Se trabaja con la lista de $producto completa y la informacion de la $receta en cuestion -->

<div class='container my-4 '>
    <h1>Agregar datos a receta "{{$Receta->nombre}}"</h1>
    <h2>Seleccione alguna de las siguientes acciones:</h2>  
    <a href="/Receta" class="btn btn-primary">Volver a lista...</a> 
        
        <div class="card my-4">
            <form method="POST" action="/Lista">         <!--Al ser el metodo post se detecta automaticamente que se llama a la funcion store --> 
            @csrf
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Producto a Receta</span>
                    
                </div>
                <div class="card-body">


                    @error('id_ingrediente')    
                    <div class="alert alert-danger" role="alert">
                        Seleccione un Producto valido.
                    </div>
                    @enderror
                    @error('cantidad_ingrediente')        
                        <div class="alert alert-danger" role="alert">
                        Debe ingresar la cantidad de ingrediente a utilizar.
                        </div>
                    @enderror 
                    @error('unidad_medida_ingrediente')                
                        <div class="alert alert-danger" role="alert">
                        Seleccione la unidad de medida correspondiente a la cantidad anterior.
                        </div>
                    @enderror  
                    @error('unidad_medida_rendimiento')              
                        <div class="alert alert-danger" role="alert">
                        Seleccione la unidad de medida.
                        </div>
                    @enderror  
                    @error('fu_utilizable')                
                        <div class="alert alert-danger" role="alert">
                        Ingrese el porcentaje de FU utilizable.
                        </div>
                    @enderror  
                    
                    
                    @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                    @endif

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <label class="input-group-text" for="id_producto">Productos</label>
                        </div>

                        <select class="custom-select" id="id_producto" name="id_ingrediente">
                        <option disabled selected value>. . .</option>
                        @foreach ($Producto as $ProductoItem)
                            <option  value="{{$ProductoItem->id}}">{{$ProductoItem->nombre}}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Cantidad por Receta</span>
                        <input type="text" aria-label="First name" class="form-control" name="cantidad_ingrediente" placeholder="Cantidad">
                        <select class="custom-select" id="unidad_medida_ingrediente" name="unidad_medida_ingrediente">
                            <option disabled selected value>Unidad</option>
                            <option  value="kg">Kilogramo(Kg)</option>
                            <option  value="g">gramo(g)</option>
                            <option  value="l">litro(l)</option>
                            <option  value="ml">mililitro(ml)</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">Costo del rendimiento</span>
                        <select class="custom-select" id="unidad_medida_rendimiento" name="unidad_medida_rendimiento">
                            <option disabled selected value>Unidad</option>
                            <option  value="kg">Kilogramo(Kg)</option>
                            <option  value="g">gramo(g)</option>
                            <option  value="l">litro(l)</option>
                            <option  value="ml">mililitro(ml)</option>
                        </select>
                        <input type="text" aria-label="First name" class="form-control" name="fu_utilizable" placeholder="FU: % utilizable">
                        <span class="input-group-text">%</span>
                        <input type="hidden" name="id_receta" value="{{$Receta->id}}" />
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                </div>
            </form>
        </div>
    <table class=" table ">
        <thead>
          <tr>
            <th scope="col">Nombre Ingrediente</th>
            <th scope="col">Cantidad De Ingrediente</th>
            <th scope="col">Unidad medida ingrediente</th>
            <th scope="col">Costo x unidad</th>
            <th scope="col">Unidad</th>
            <th scope="col">FU: % utilizable</th>
            <th scope="col">FU / Unidad</th>
            <th scope="col">Costo Receta</th>
          </tr>
        </thead>

        @foreach ($lista_recetas_producto as $item)
            <tbody>
            <tr>
                
                <td>{{$item->nombre_ingrediente}}</td>
                
                <td>{{$item->cantidad_ingrediente}}</td>

                <td>{{$item->unidad_medida_ingrediente}}</td>

                <td>...</td>

                <td>{{$item->unidad_medida_rendimiento}}</td>

                <td>{{$item->fu_utilizable}}%</td>

                <td>{{$item->fu_unidad}}$</td>

                <td>{{$item->costo_receta_producto}}</td>
                
            </tr>
            </tbody>
        @endforeach
        
    </table>
</div>




@endsection
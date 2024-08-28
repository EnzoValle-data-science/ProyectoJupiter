@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 py-1">
            <div class="card" style="width: 60rem;">
                
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar receta</span>
                    <a href="/Receta" class="btn btn-primary btn-sm">Volver a lista...</a>
                </div>
                <div class="card-body">

    <form method="POST" action="/Receta">         <!--Al ser el metodo post se detecta automaticamente que se llama a la funcion store --> 
                        @csrf
                        @error('nombre')                
                        <div class="alert alert-danger" role="alert">
                            El nombre de la receta es obligatorio.
                        </div>
                        @enderror
                        @error('categoria_receta')                
                            <div class="alert alert-danger" role="alert">
                            La categoría de la receta es obligatoria.
                            </div>
                        @enderror 
                        @error('numero_porciones')               
                            <div class="alert alert-danger" role="alert">
                            El número de porciones por receta es obligatorio.
                            </div>
                        @enderror
                        @error('unidad_porcion')                
                            <div class="alert alert-danger" role="alert">
                            La unidad de la porción es obligatoria.
                            </div>
                        @enderror 
                        @error('cantidad_porcion')                
                            <div class="alert alert-danger" role="alert">
                            La cantidad de porciones es un valor obligatorio.
                            </div>
                        @enderror   
                        @error('precio_porcion')                
                            <div class="alert alert-danger" role="alert">
                            El precio de venta por porción debe ser un valor numérico y es obligatorio.
                            </div>
                        @enderror 
                                
                        @if ( session('mensaje') )
                        <div class="alert alert-success">{{ session('mensaje') }}</div>
                        @endif

                    <input
                    type="text"
                    name="nombre"     
                    placeholder="Nombre"
                    class="form-control mb-2"
                    />
                    <input
                    type="text"
                    name="categoria_receta"     
                    placeholder="Categoría De Receta"
                    class="form-control mb-2"
                    />
                </div>
            </div>
        </div>


        <div class="col-md-8 py-1">
            <div class="card" style="width: 60rem;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Rendimiento de la Receta</span>
                </div>
                <div class="card-body">
                        <input
                        type="text"
                        name="numero_porciones"     
                        placeholder="Numero de porciones"
                        class="form-control mb-2"
                        />

                        <select class="custom-select mb-2" id="unidad_porcion" name="unidad_porcion">
                            <option disabled selected value>. . .</option>
                            <option  value="Kg/g">Kilogramo</option>
                            <option  value="Kg/g">Gramo</option>
                            <option  value="L/ml">Litro</option>
                            <option  value="L/ml">Mililitro</option>
                        </select>

                        <input
                        type="text"
                        name="cantidad_porcion"     
                        placeholder="Cantidad por porción"
                        class="form-control mb-2"
                        />
                   
                    
                </div>
            </div>
        </div>
        <div class="col-md-8 py-1">
            <div class="card" style="width: 60rem;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Venta</span>
                </div>
                <div class="card-body">
                        <input
                        type="text"
                        name="precio_porcion"     
                        placeholder="Precio venta porción"
                        class="form-control mb-3"
                        />

                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                   
                    
                </div>
            </div>
        </div>
    </div>
    </form>
</div>

@endsection
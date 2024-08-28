@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Agregar Producto</span>
                    <a href="/Producto" class="btn btn-primary btn-sm">Volver a lista...</a>
                </div>
                <div class="card-body">
                    

                    @error('nombre')                <!-- llega el error desde el metodo Producto.store --> 
                    <div class="alert alert-danger" role="alert">
                        El nombre del producto es obligatorio.
                    </div>
                    @enderror
                    @error('descripcion')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        La descripcion es obligatoria.
                        </div>
                    @enderror 
                    @error('unidad_medida')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        La Unidad de medida es obligatoria.
                        </div>
                    @enderror  
                    
                    
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <form method="POST" action="/Producto">
                    @csrf
                    <input
                      type="text"
                      name="nombre"     
                      placeholder="Nombre"
                      class="form-control mb-2"
                    />
                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripción"
                      class="form-control mb-2"
                    />
                    
                    <input type="hidden" name="cantidad" value="0" />
                    
                    <input type="hidden" name="valor" value="0" />

                    <div class="input-group mb-3">

                      <div class="input-group-prepend">
                        <label class="input-group-text" for="id_producto">Unidad de medida</label>
                      </div>    

                      <select class="custom-select" id="id_producto" name="unidad_medida">
                        <option disabled selected value>. . .</option>
                        <option  value="Kg/g">Kilogramo / gramo</option>
                        <option  value="L/ml">Litro / mililitro</option>
                      </select>

                    </div>

                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
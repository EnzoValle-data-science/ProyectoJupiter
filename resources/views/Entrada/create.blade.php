@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Generar Entrada</span>
                    <a href="/Entrada" class="btn btn-primary btn-sm">Volver a lista...</a>
                </div>
                <div class="card-body">
                    

                    @error('id_producto')                <!-- llega el error desde el metodo Producto.store --> 
                    <div class="alert alert-danger" role="alert">
                        El ID de producto es obligatorio.
                    </div>
                    @enderror
                    @error('descripcion')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        La descripción es obligatoria.
                        </div>
                    @enderror 
                    @error('cantidad')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        El campo “cantidad” debe ser un numero entero y es obligatorio.
                        </div>
                    @enderror
                    @error('unidad_medida')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        La unidad de medida es obligatoria.
                        </div>
                    @enderror 
                    @error('valor')                <!-- llega el error desde el metodo Producto.store --> 
                        <div class="alert alert-danger" role="alert">
                        El valor de la entrada es obligatorio.
                        </div>
                    @enderror   
                    
                    
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <form method="POST" action="/Entrada">
                    @csrf
                    
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="id_producto">Productos</label>
                        </div>

                                                
                        <select class="custom-select" id="id_producto" name="id_producto">
                          <option disabled selected value>. . .</option>
                        @foreach ($Producto as $ProductoItem)
                            <option  value="{{$ProductoItem->id}}">{{$ProductoItem->nombre}}</option>
                        @endforeach
                        </select>
                      </div>

                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripción"
                      class="form-control mb-2"
                    />
                    <input
                      type="text"
                      name="cantidad"
                      placeholder="Cantidad"
                      class="form-control mb-2"
                    />
                    
                    <div class="input-group mb-3">
                      <span class="input-group-text">Unidad de medida</span>
                      <select class="custom-select" id="unidad_medida" name="unidad_medida">
                        <option disabled selected value>. . .</option>
                          <option  value="kg">Kilogramo (Kg)</option>
                          <option  value="g">Gramo (g)</option>
                          <option  value="l">Litro (l)</option>
                          <option  value="ml">Mililitro (ml)</option>
                      </select>
                    </div>

                    <div class="input-group mb-1">
                      <input
                        type="text"
                        name="valor"
                        placeholder="Valor"
                        class="form-control mb-2"
                      />
                      <span class="input-group-text mb-2">$</span>
                      </div>

                    <input type="hidden" name="autor" value="{{auth()->user()->name}}" />
                    <input type="hidden" name="id_autor" value="{{auth()->user()->id}}" />
                    

                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
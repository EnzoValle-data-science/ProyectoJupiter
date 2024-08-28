@extends('layouts.app')


@section('content')
    
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Actualizar Producto</span>
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
                          La descripción es obligatoria.
                        </div>
                    @enderror 
                    
                    
                  @if ( session('mensaje') )
                    <div class="alert alert-success">{{ session('mensaje') }}</div>
                  @endif
                  <form  action="{{route('Producto.update',$ProductoEditar)}}" method="POST">
                    @method("PUT")
                    @csrf

                    <input
                      type="text"
                      name="nombre"     
                      placeholder="Nombre" 
                      value="{{ $ProductoEditar->nombre }}"
                      class="form-control mb-2"
                    />
                    <input
                      type="text"
                      name="descripcion"
                      placeholder="Descripción"
                      value="{{ $ProductoEditar->descripcion }}"
                      class="form-control mb-2"
                    />
                    <button class="btn btn-primary btn-block" type="submit">Agregar</button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

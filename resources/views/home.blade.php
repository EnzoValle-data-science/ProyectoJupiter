@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="text-center text-success ">{{ __('Estas Validado y Autenticado!') }}</h1>
            <div class="card">
                <div class="card-header">{{ __('Inicio') }}</div>

                    <figure class="text-center">
                    <blockquote class="blockquote">
                      <h2>Datos del Usuario:</h2>
                    </blockquote>
                    <h4>Nombre: {{auth()->user()->name}}</h4>
                    <h4>Email: {{auth()->user()->email}}</h4>
                    <!--    <h4>Contraseña Cifrada: {{auth()->user()->password}} </h4>     -->
                    </figure>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

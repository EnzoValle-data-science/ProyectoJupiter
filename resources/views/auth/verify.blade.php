@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique su dirección de email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un token de validación fue enviado a su correo.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor Revise su email por un código de verificación.') }}
                    {{ __('Si no recibiste un email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('haga click aquí !') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

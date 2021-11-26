@extends('layouts.plantilla')

@section('title', 'Registro Administradores')

@section('content')

@section('tituloBarra', 'Registro de Administradores')

@section('tituloPagina', 'Registro de Administradores')

<div class="main-panel" id="main-panel">


    <div class="content">
            <div class="">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="title">Registrar Administrador</h5>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">

                                @csrf
                                <div class="">
                                    <div class="">
                                      <div class="form-group">
                                        <label>Nombre de Usuario</label>
                                        <input placeholder="Nombre" id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                      </div>
                                    </div>
                                  </div>

                                <div class="">
                                    <div class="">
                                      <div class="form-group">
                                        <label>Correo Electrónico</label>
                                        <input placeholder="Correo" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                      </div>
                                    </div>
                                  </div>

                                <div class="">
                                    <div class="">
                                      <div class="form-group">
                                        <label>Contraseña</label>
                                        <input placeholder="Contraseña" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                      </div>
                                    </div>
                                  </div>

                                <div class="">
                                    <div class="">
                                      <div class="form-group">
                                        <label>Confirmar Contraseña</label>
                                        <input placeholder="Confirmación de Contraseña" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        
                                      </div>
                                    </div>
                                </div>

                               <br>
                                <button style="width: 120px; height: 50px;" type="submit" class="buttons">
                                    {{ __('Agregar') }}
                                </button>
                                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
</div>
@endsection

@extends('layouts.plantilla')

@section('title', 'Tabla Clientes')

@section('content')

@section('tituloBarra', 'Tabla Clientes')

@section('tituloPagina', 'Tabla de Clientes')

<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Clientes</h4>
              </div>

              <tablaclientes-component></tablaclientes-component>

            </div>
          </div>

    
        </div>
      </div>
@endsection

@extends('layouts.plantilla')

@section('title', 'Tabla Servicios')

@section('content')

@section('tituloBarra', 'Tabla Servicios')

@section('tituloPagina', 'Tabla de Servicios')

<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Servicios</h4>
              </div>

              <tablaservicios-component></tablaservicios-component>

            </div>
          </div>

    
        </div>
      </div>
@endsection

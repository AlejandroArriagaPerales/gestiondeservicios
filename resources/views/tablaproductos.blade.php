@extends('layouts.plantilla')

@section('title', 'Tabla Productos')

@section('content')

@section('tituloBarra', 'Tabla Productos')

@section('tituloPagina', 'Tabla de Productos')

<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Productos</h4>
              </div>

              <tablaproductos-component></tablaproductos-component>

            </div>
          </div>

    
        </div>
      </div>
@endsection

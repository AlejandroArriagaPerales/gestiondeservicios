@extends('layouts.plantilla')

@section('title', 'Tabla Administradores')

@section('content')

@section('tituloBarra', 'Tabla Administradores')

@section('tituloPagina', 'Tabla de Administradores')
<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Administradores</h4>
              </div>
              
              <tablaadministradores-component></tablaadministradores-component>

            </div>
          </div>

    
        </div>
      </div>
@endsection


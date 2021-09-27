@extends('layouts.plantilla')

@section('title', 'Registro Servicios')
    
@section('content')

@section('tituloBarra', 'Registro de Servicios')

@section('tituloPagina', 'Registro de Servicios')
    
  <div class="main-panel" id="main-panel">
    <div class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              <h5 class="title">Registrar Servicio</h5>
            </div>

            <serviciosform-component></serviciosform-component>
          </div>
        </div>
      </div>
    </div>
  </div>
      
      
@endsection


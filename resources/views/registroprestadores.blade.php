@extends('layouts.plantilla')

@section('title', 'Registro Prestadores')
    
@section('content')

@section('tituloBarra', 'Registro de Prestadores')

@section('tituloPagina', 'Registro de Prestadores')
    
  <div class="main-panel" id="main-panel">
    <div class="content">
      <div class="row">
        <div class="col-lg-8">
          <div class="card">

            <div class="card-header">
              <h5 class="title">Registrar Prestador de Servicio</h5>
            </div>

            <prestadoresform-component></prestadoresform-component>
          </div>
        </div>      
      </div>     
    </div>
  </div>
      
@endsection


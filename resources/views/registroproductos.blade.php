@extends('layouts.plantilla')

@section('title', 'Registro Productos')
    
@section('content')

@section('tituloBarra', 'Registro de Productos')

@section('tituloPagina', 'Registro de Productos')
    
  <div class="main-panel" id="main-panel">
    <div class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              <h5 class="title">Registrar Productos</h5>
            </div>

            <productosform-component></productosform-component>
          </div>
        </div>      
      </div>     
    </div>
  </div>
      
@endsection


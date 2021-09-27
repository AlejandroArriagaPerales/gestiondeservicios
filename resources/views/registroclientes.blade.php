@extends('layouts.plantilla')

@section('title', 'Registro Clientes')
    
@section('content')

@section('tituloBarra', 'Registro de Clientes')

@section('tituloPagina', 'Registro de Clientes')
    
  <div class="main-panel" id="main-panel">
    <div class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              <h5 class="title">Registrar Cliente</h5>
            </div>

            <clientesform-component></clientesform-component>
          </div>
        </div>  
      </div> 
    </div>
  </div>
      
@endsection


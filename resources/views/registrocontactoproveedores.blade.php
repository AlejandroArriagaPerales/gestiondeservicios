@extends('layouts.plantilla')

@section('title', 'Registro Contactos')
    
@section('content')

@section('tituloBarra', 'Registro de Contactos')

@section('tituloPagina', 'Registro de Contactos')
    
  <div class="main-panel" id="main-panel">
    <div class="content">
      <div class="">
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              <h5 class="title">Registrar Contacto</h5>
            </div>

            <contactoproveedoresform-component></contactoproveedoresform-component>
          </div>
        </div>
      </div>
    </div>
  </div>
      
      
@endsection


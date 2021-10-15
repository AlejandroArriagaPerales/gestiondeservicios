@extends('layouts.plantilla')

@section('title', 'Tabla Contactos')

@section('content')

@section('tituloBarra', 'Tabla Contactos')

@section('tituloPagina', 'Tabla de Contactos de Proveedores')
<div class="main-panel" id="main-panel">
<div class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Contactos de Proveedores</h4>
              </div>

              <tablacontactosproveedores-component></tablacontactosproveedores-component>

            </div>
          </div>

    
        </div>
      </div>
</div>
@endsection

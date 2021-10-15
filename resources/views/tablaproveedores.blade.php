@extends('layouts.plantilla')

@section('title', 'Tabla Proveedores')

@section('content')

@section('tituloBarra', 'Tabla Proveedores')

@section('tituloPagina', 'Tabla de Proveedores')
<div class="main-panel" id="main-panel">
<div class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Proveedores</h4>
              </div>

              <tablaproveedores-component></tablaproveedores-component>

            </div>
          </div>

    
        </div>
      </div>
</div>
@endsection

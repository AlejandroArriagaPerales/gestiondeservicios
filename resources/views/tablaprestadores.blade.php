@extends('layouts.plantilla')

@section('title', 'Tabla Prestadores')

@section('content')

@section('tituloBarra', 'Tabla Prestadores')

@section('tituloPagina', 'Tabla de Prestadores')
<div class="main-panel" id="main-panel">
<div class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Prestadores de Servicios</h4>
              </div>

              <tablaprestadores-component></tablaprestadores-component>

            </div>
          </div>

    
        </div>
      </div>
</div>
@endsection

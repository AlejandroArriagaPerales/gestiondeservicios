@extends('layouts.plantilla')

@section('title', 'Tabla Métodos')

@section('content')

@section('tituloBarra', 'Tabla Métodos')

@section('tituloPagina', 'Tabla de Métodos de Pago')
<div class="main-panel" id="main-panel">
<div class="content">
        <div class="row">
          <div class="col-md-10">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Métodos de Pago</h4>
              </div>

              <tablametodospago-component></tablametodospago-component>

            </div>
          </div>

    
        </div>
      </div>
</div>
@endsection

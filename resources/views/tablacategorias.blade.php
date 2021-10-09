@extends('layouts.plantilla')

@section('title', 'Tabla Categorias')

@section('content')

@section('tituloBarra', 'Tabla Categorias')

@section('tituloPagina', 'Tabla de Categorias')

<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Categorias</h4>
              </div>

              <tablacategorias-component></tablacategorias-component>

            </div>
          </div>

    
        </div>
      </div>
@endsection

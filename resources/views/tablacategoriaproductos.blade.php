@extends('layouts.plantilla')

@section('title', 'Tabla Categoria Productos')

@section('content')

@section('tituloBarra', 'Tabla Categoria Productos')

@section('tituloPagina', 'Tabla de Categoria de Productos')

<div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Categoria de Productos</h4>
              </div>

              <tablacategoriaproductos-component></tablacategoriaproductos-component>

            </div>
          </div>

    
        </div>
      </div>
@endsection

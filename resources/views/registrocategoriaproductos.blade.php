@extends('layouts.plantilla')

@section('title', 'Registro Categoria Productos')
    
@section('content')

@section('tituloBarra', 'Registro de Categoria Productos')

@section('tituloPagina', 'Registro de Categoria Productos')
    
  <div class="main-panel" id="main-panel">
    <div class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="card">

            <div class="card-header">
              <h5 class="title">Registrar Categoria de Productos</h5>
            </div>

            <categoriaproductosform-component></categoriaproductosform-component>
          </div>
        </div>
      </div>
    </div>
  </div>
      
      
@endsection


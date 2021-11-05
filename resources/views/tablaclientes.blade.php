@extends('layouts.plantilla')

@section('title', 'Tabla Clientes')

@section('content')

@section('tituloBarra', 'Tabla Clientes')

@section('tituloPagina', 'Tabla de Clientes')
<div style="margin: auto;" class="col-md-11" >
  <tablaclientes-component></tablaclientes-component>
</div>
@endsection

@extends('layouts.plantilla')

@section('title', 'Registro Admins')

@section('content')

@section('tituloBarra', 'Registro de Administradores')

@section('tituloPagina', 'Registro Administradores')

<div class="main-panel" id="main-panel">
        
      
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Registrar Administrador</h5>
              </div>
              <div class="card-body">

                <form action="dashboard.html">

                  
                <div class="">
                    <div class="">
                      <div class="form-group">
                        <label>Nombre de Usuario</label>
                        <input type="text" class="form-control" placeholder="Nombre de Usuario">
                      </div>
                    </div>

                    </div>

                    <div class="">
                    <div class="">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Correo Electrónico</label>
                        <input type="email" class="form-control" placeholder="Correo Electrónico">
                      </div>
                    </div>

                    </div>

                    <div class="">
                    <div class="">
                      <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" class="form-control" placeholder="Contraseña" >
                      </div>
                    </div>

                    </div>

                    <div class="">
                    <div class="">
                      <div class="form-group">
                        <label>Confirmar Contraseña</label>
                        <input type="password" class="form-control" placeholder="Confirmar Contraseña" >
                      </div>
                    </div>

                    </div>
              
                    <br>
                        <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">
                        </div>
                </form>
                
              </div>
              
            </div>
          </div>
         
        </div>
      </div>
      
@endsection




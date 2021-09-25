@extends('layouts.plantilla')

@section('title', 'Registro Prestadores')
    
@section('content')

@section('tituloBarra', 'Registro de Prestadores')

@section('tituloPagina', 'Registro de Prestadores')
    
<div class="main-panel" id="main-panel">
      <!-- Navbar -->
      
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Registrar Prestador de Servicio</h5>
              </div>
              <div class="card-body">
                <form action="dashboard">
                  <div class="">
                    <div class="">
                      <div class="form-group">
                        <label>Nombre(s)</label>
                        <input type="text" class="form-control" placeholder="Nombre(s)">
                      </div>
                    </div>

                    </div>

                    <div class="">
                    <div class="">
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" class="form-control" placeholder="Apellidos">
                      </div>
                    </div>

                    </div>

                    <div class="">
                    <div class="">
                      <div class="form-group">
                        <label>Correo Electrónico</label>
                        <input type="email" class="form-control" placeholder="Correo Electrónico">
                      </div>
                    </div>
                    </div>

                    <div class="">
                    <div class="">
                      <div class="form-group">
                        <label>Dirección</label>
                        <input type="text" class="form-control" placeholder="Dirección">
                      </div>
                    </div>
                    </div>

                    <div class="">
                    <div class="">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Teléfono</label>
                        <input type="tel" class="form-control" placeholder="Teléfono">
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


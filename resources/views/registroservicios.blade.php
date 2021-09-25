@extends('layouts.plantilla')

@section('title', 'Registro Servicios')
    
@section('content')

@section('tituloBarra', 'Registro de Servicios')

@section('tituloPagina', 'Registro de Servicios')
    
<div class="main-panel" id="main-panel">
      
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Registrar Servicio</h5>
              </div>
              <div class="card-body">
                <form action="../index.php">
                
                    <div class="form-group">
                        <label>Nombre(s)</label>
                        <input type="text" class="form-control" placeholder="Nombre(s)">
                      </div>
                    <br>

                    <div class="form-group">
                      <label>Selecciona una categoria</label>
                      <select  class="form-control">
                        <option value="1">Albañil</option>
                        <option value="2">Pintor</option>
                        <option value="3">Electricista</option>
                        <option value="4">Plomero</option>

                    </select>
                    </div>
                    
                    
                    <br>
                    <br>
                    
                    <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">
                    <br>
                    </div>

                        
               
                    </div>
                    
                </form>
            </div>
              </div>
              
            </div>
         
         
        </div>
      </div>
      
@endsection


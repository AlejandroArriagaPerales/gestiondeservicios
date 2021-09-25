@extends('layouts.plantilla')

@section('title', 'Registro Clientes')
    
@section('content')

@section('tituloBarra', 'Registro de Clientes')

@section('tituloPagina', 'Registro de Clientes')
    
<div class="main-panel" id="main-panel">
      
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
        <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h5 class="title">Registrar Cliente</h5>
              </div>
              <div class="card-body">
                <form action="../index.php">
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
                        <label>Registro Federal de Contribuyentes (RFC)</label>
                        <input type="email" class="form-control" placeholder="Correo Electrónico">
                      </div>
                    </div>
                    </div>

                    <div class="seleccionar">
                        <label for="img" class="negrita">Selecciona una imagen:</label>                         
                        <div>
                        <input name="img[]" type="file" id="img" multiple="multiple" >
                        <br>
                        <br>
                        @if ( !empty ( $bicicletas->imagenes) )
      
                          <span>Imagen(es) Actual(es): </span>
                          <br>
      
                          <!-- Mensaje: Imagen Eliminada Satisfactoriamente ! -->
                          @if(Session::has('message'))
                            <div class="alert alert-primary" role="alert">
                              {{ Session::get('message') }}
                            </div>
                          @endif
      
                          <!-- Mostramos todas las imágenes pertenecientesa a este registro -->
                          @foreach($imagenes as $img)                    
                              
                              <img src="../../../uploads/{{ $img->nombre }}" width="200" class="img-fluid"> 
      
                              <!-- Botón para Eliminar la Imagen individualmente -->
                              <a href="{{ route('admin/bicicletas/eliminarimagen', [$img->id, $bicicletas->id]) }}" class="btn btn-danger btn-sm" onclick="return confirmarEliminar();">Eliminar</a> 
      
                          @endforeach
      
                          
      
                        @else
    
      
                        @endif                
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
                        <input style="width: 120px; height: 50px; background:#F96332;" class="buttons" type="submit" name="" value="Agregar">
                        
               
                    </div>
                    
                </form>
            </div>
              </div>
              
            </div>
         
         
        </div>
      </div>
      
@endsection


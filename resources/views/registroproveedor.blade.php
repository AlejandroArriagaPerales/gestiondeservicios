@extends('layouts.plantilla')




@section('title', 'Registro Proveedores')
    
@section('content')

@section('tituloBarra', 'Registro de Proveedores')

@section('tituloPagina', 'Registro de Proveedores')

  <div class="main-panel" id="main-panel">
        
  
    
    <div class="content">
      <div class="">
         <div class="col-md-8">
            <div class="card">

              <div class="card-header">
                <h5 class="title">Registrar Proveedor</h5>
              </div>
              
              <proveedoresform-component></proveedoresform-component>
              
            </div>     
         </div>            
       </div>
    </div>               
  </div>
          
          
  
        
        
      
@endsection



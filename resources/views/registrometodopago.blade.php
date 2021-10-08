@extends('layouts.plantilla')




@section('title', 'Registro Metodo Pago')
    
@section('content')

@section('tituloBarra', 'Registro de Metodo Pago')

@section('tituloPagina', 'Registro de Metodo de Pago')

  <div class="main-panel" id="main-panel">
        
  
    
    <div class="content">
      <div class="row">
         <div class="col-md-8">
            <div class="card">

              <div class="card-header">
                <h5 class="title">Registrar Metodo de Pago</h5>
              </div>
              
              <metodopagoform-component></metodopagoform-component>
              
            </div>     
         </div>            
       </div>
    </div>               
  </div>
          
          
  
        
        
      
@endsection



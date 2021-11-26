@extends('layouts.plantilla')




@section('title', 'Registro Categorias')
    
@section('content')

@section('tituloBarra', 'Registro de Categorias')

@section('tituloPagina', 'Registro de Categorias')

  <div class="main-panel" id="main-panel">
        
  
    
    <div class="content">
      <div class="">
         <div class="col-md-8">
            <div class="card">

              <div class="card-header">
                <h5 class="title">Registrar Categoria</h5>
              </div>
              
              <categoriasform-component></categoriasform-component>
              
            </div>     
         </div>            
       </div>
    </div>               
  </div>
          
          
  
        
        
      
@endsection



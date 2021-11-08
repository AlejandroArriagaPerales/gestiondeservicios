<template>
    <div class="card-body">
                <form action="" v-on:submit.prevent="newCategoria()">
                        
                  <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreCategoria">
                  </div>
                  <div class="form-group">
                    <label>Costo de la visita</label>
                    <input type="text" class="form-control" placeholder="Costo" v-model="costoVisitaCategoria">
                  </div>
                  <br>

                  
                  <div class="seleccionar">
                    <label for="img" class="negrita">Selecciona un icono:</label>   
                    <br>          

                      <div>
                        <input name="img[]" type="file" id="img" multiple="multiple" >
                        <br>
                        <br>
                        <!--
                        @if ( !empty ( $bicicletas->imagenes) )
                          <span>Imagen(es) Actual(es): </span>
                          <br>

                          @if(Session::has('message'))
                            <div class="alert alert-primary" role="alert">
                              {{ Session::get('message') }}
                            </div>
                          @endif

                          @foreach($imagenes as $img)                    
                            <img src="../../../uploads/{{ $img->nombre }}" width="200" class="img-fluid"> 
                            <a href="{{ route('admin/bicicletas/eliminarimagen', [$img->id, $bicicletas->id]) }}" class="btn btn-danger btn-sm" onclick="return confirmarEliminar();">Eliminar</a> 
                          @endforeach

                        @else
                        @endif 
                        -->

                      </div>
            
                  </div>
                  
       
                  <br>
                  <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">
                  <br>
                </form>
              </div>
</template>

<script>


    export default {
        data(){
            return {
                nombreCategoria: '',
                costoVisitaCategoria: ''
            }
            
        },
        mounted() {
        
        },
        methods: {
            newCategoria(){
                const params = {
                    nombreCategoria: this.nombreCategoria,
                    costoVisitaCategoria: this.costoVisitaCategoria
                    
                };
                this.nombreCategoria='';
                this.costoVisitaCategoria='';
                
                
                
                axios.post('tab_categorias',params).then((response) => {
                  const nombreCategoria = response.data;
                  const costoVisitaCategoria = response.data;
                  this.$emit('new',nombreCategoria);
                  this.$emit('new',costoVisitaCategoria);
                  Vue.swal("Categoria Agregada", "", "success");
                });
                
             
                
            }
        }
    }
</script>





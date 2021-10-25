<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newServicio()">

                <div class="form-group">
                  <label>Selecciona una categoria</label>

                    
                    <v-select  v-model="categoriaSeleccionada" label="nombre"  :options="tab_categorias" :reduce="nombre => nombre.id"  :searchable="true" >
                    </v-select>

                     

                </div>

                <br>

                <div class="form-group">
                  <label>Nombre(s)</label>
                  <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreServicio">
                </div>
 
                <br>
                <br>
                    
                <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">

                <br>  
              </form>
              <!--
                <div v-for="tab_categoria in tab_categorias" v-bind:key="tab_categoria.id">
                    {{tab_categorias}}
                </div>
              -->
              
            </div>

            
</template>

<script>

  import axios from "axios";
  
    export default {
      created(){
        axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
      },
        data(){
            return {
                nombreServicio: '',
                categoriaSeleccionada: '',
                tab_categorias: []
            }
            
        },
        mounted() {
            
        },
        methods: {
            newServicio(){
                const params = {
                    nombreServicio: this.nombreServicio,
                    categoriaSeleccionada: this.categoriaSeleccionada
                };
                this.nombreServicio='';
                this.categoriaSeleccionada='';
                
                axios.post('tab_servicios',params).then((response) => {
                  const categoriaSeleccionada = response.data;
                  const nombreServicio = response.data;
                  
                  this.$emit('new',nombreServicio);
                  this.$emit('new',categoriaSeleccionada);
                  Vue.swal("Servicio Agregado", "", "success");
                });
             
                
            },
            Recibido(){
              
              
            }
        }
    }
</script>


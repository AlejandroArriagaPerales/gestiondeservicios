<template>

    <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Nombre
                      </th>
                      <th>
                        ID Categoria
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_servicio) in tab_servicios" :key="tab_servicio.id">
                        <td>
                          {{tab_servicio.nombre}}
                        </td>
                        <td>
                          {{tab_servicio.categoria_id}}
                        </td>
                       
                      </tr>
                        
                      
                    </tbody>
                  </table>
                </div>
              </div>

            
</template>

<script>

  import axios from "axios";
  
    export default {
      created(){
        axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
      },
        data(){
            return {
                tab_servicios: []
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
                confirm('Servicio Agregado', 'Confirmación');
                axios.post('tab_servicios',params).then((response) => {
                  const categoriaSeleccionada = response.data;
                  const nombreServicio = response.data;
                  
                  this.$emit('new',nombreServicio);
                  this.$emit('new',categoriaSeleccionada);
                });
             
                
            },
            Recibido(){
              
              
            }
        }
    }
</script>










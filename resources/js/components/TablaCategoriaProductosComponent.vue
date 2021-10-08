<template>

    <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Nombre
                      </th>
                      <th>
                        ID Proveedor
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_categoriaproducto) in tab_categoriaproductos" :key="tab_categoriaproducto.id">
                        <td>
                          {{tab_categoriaproducto.nombre}}
                        </td>
                        <td>
                          {{tab_categoriaproducto.proveedore_id}}
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
        axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
      },
        data(){
            return {
                tab_categoriaproductos: []
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










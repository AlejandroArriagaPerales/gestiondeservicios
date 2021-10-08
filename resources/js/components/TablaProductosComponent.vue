<template>

    <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Nombre
                      </th>
                      <th>
                        Precio
                      </th>
                      <th>
                        ID Categoria Producto
                      </th>
                      <th>
                        Fecha Creacion Precio
                      </th>
                        
                  
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_producto) in tab_productos" :key="tab_producto.id">
                        <td>
                          {{tab_producto.nombre}}
                        </td>
                        <td>
                          {{tab_producto.precio}}
                        </td>
                        <td>
                          {{tab_producto.categoriaProducto_id}}
                        </td>
                        <td>
                          {{tab_producto.created_at}}
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
        axios.get('tab_productos').then(response => this.tab_productos = response.data);
      },
        data(){
            return {
                tab_productos: []
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







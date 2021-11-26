<template>

    <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Nombre de Usuario
                      </th>
                      <th>
                        Correo Electrónico
                      </th>
                      
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          Dakota Rice
                        </td>
                       
                        <td>
                          Oud-Turnhout@hotmail.com
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


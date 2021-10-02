<template>

    <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Nombre(s)
                      </th>
                      <th>
                        Apellidos
                      </th>
                      <th>
                        Correo Electrónico
                      </th>
                      <th>
                        Ubicación
                      </th>
                      <th>
                        Teléfono
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_prestadore) in tab_prestadores" :key="tab_prestadore.id">
                        <td>
                          {{tab_prestadore.nombre}}
                        </td>
                        <td>
                          {{tab_prestadore.apellido}}
                        </td>
                        <td>
                          {{tab_prestadore.correo}}
                        </td>
                        <td>
                          {{tab_prestadore.ubicacion}}
                        </td>
                        <td>
                          {{tab_prestadore.telefono}}
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
        axios.get('tab_prestadores').then(response => this.tab_prestadores = response.data);
      },
        data(){
            return {
                tab_prestadores: []
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










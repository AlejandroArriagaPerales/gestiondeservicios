<template>
    <table class="tabla">
                  <tr>
                    <td>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Categoria</label>
                              <select class="form-control" v-model="categoriaSeleccionada" >
                                <option :value="tab_categoria.id" v-for="(tab_categoria) in tab_categorias" :key="tab_categoria.id" >
                                  {{tab_categoria.nombre}}
                                </option>
                              </select>
                            </div>        
                    </td>
                    <td>      
                            <div class="form-group">
                              <label for="exampleInputEmail1">Servicio</label>

                              <select class="form-control"  v-model="servicioSeleccionado" >
                                <option :value="tab_servicio.id"  v-for="(tab_servicio) in tab_servicios" :key="tab_servicio.id" >
                                  {{tab_servicio.nombre}}
                                </option>
                              </select>
                            </div>               
                    </td>
                    <td>
                            <button class="buttontabla" v-on:click.prevent="AgregarServicio()">Aceptar</button>   
                    </td>
                  </tr>
    </table>
</template>

<script>
import axios from "axios";
    export default {
      created(){
        axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
        axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
      },
        data(){
            return {
                nombrePrestador: '',
                apellidoPrestador: '',
                correoPrestador: '',
                ubicacionPrestador: '',
                telefonoPrestador: '',
                contrasenaPrestador: '',
                disponibilidadSeleccionada: '',
                tab_categorias: [],
                tab_servicios: []
            }
            
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            AgregarServicio(){
                
                confirm('Servicio Agregado', 'Confirmación');
                
             
                
            }
        }
    }
</script>


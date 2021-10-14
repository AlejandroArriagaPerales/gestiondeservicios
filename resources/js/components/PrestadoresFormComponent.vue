<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newPrestador()">
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Nombre(s)</label>
                      <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombrePrestador">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" class="form-control" placeholder="Apellidos" v-model="apellidoPrestador">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Correo Electrónico</label>
                      <input type="email" class="form-control" placeholder="Correo Electrónico" v-model="correoPrestador">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control" placeholder="Dirección" v-model="ubicacionPrestador">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Teléfono</label>
                      <input type="tel" class="form-control" placeholder="Teléfono" v-model="telefonoPrestador">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Seleccione una imagen</label>
                      
                    </div>
                  </div>
                </div>
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

                
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Disponiblidad</label>
                      <select class="form-control" v-model="disponibilidadSeleccionada" >
                        <option :value="1">Disponible</option>
                        <option :value="0">No Disponible</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Contraseña</label>
                      <input type="password" class="form-control" placeholder="Contraseña" v-model="contrasenaPrestador">
                    </div>
                  </div>
                </div>
                  
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Confirmar Contraseña</label>
                      <input type="password" class="form-control" placeholder="Confirmar Contraseña" >
                    </div>
                  </div>
                </div>

                <table class="tabla">
                  <tr>
                    <td>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Categoria</label>
                              <select class="form-control" v-model="categoriaSeleccionada" @change="getServiciosCategorias()">
                                <option :value="tab_categoria.id" v-for="(tab_categoria) in tab_categorias" :key="tab_categoria.id" >
                                  {{tab_categoria.nombre}}
                                </option>
                              </select>
                            </div>        
                    </td>
                    <td>      
                            <div class="form-group">
                              <label for="exampleInputEmail1">Servicio</label>

                              <select class="form-control"  v-model="servicioSeleccionado" v-if="categoriaSeleccionada" @change="getServicio()">

                                <option :value="tab_servicio.id" v-for="tab_servicio in tab_servicios" v-if="tab_servicio.categoria_id === categoriaSeleccionada" :key="tab_servicio.id" >
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


                
               

                
                
                <br>           
                <br>
                <br>
                <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Guardar">
                        
              </form>
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
                nombrePrestador: '',
                apellidoPrestador: '',
                correoPrestador: '',
                ubicacionPrestador: '',
                telefonoPrestador: '',
                contrasenaPrestador: '',
                categoriaSeleccionada: '',
                servicioSeleccionado: '',
                disponibilidadSeleccionada: '',
                tab_categorias: [],
                tab_servicios: [],
                serviciosAgregados: [],
                cantidadServiciosAgregados: 0,
                categoriasAgregadas: [],
                cantidadCategoriasAgregadas: 0
            }
            
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newPrestador(){
                const params = {
                    nombrePrestador: this.nombrePrestador,
                    apellidoPrestador: this.apellidoPrestador,
                    correoPrestador: this.correoPrestador,
                    ubicacionPrestador: this.ubicacionPrestador,
                    telefonoPrestador: this.telefonoPrestador,
                    contrasenaPrestador: this.contrasenaPrestador,
                    disponibilidadSeleccionada: this.disponibilidadSeleccionada,
                    serviciosAgregados: this.serviciosAgregados,
                    categoriasAgregadas: this.categoriasAgregadas
                };
                this.nombrePrestador='';
                this.apellidoPrestador='';
                this.correoPrestador='';
                this.ubicacionPrestador='';
                this.telefonoPrestador='';
                this.contrasenaPrestador='';
                this.disponibilidadSeleccionada="";
                confirm('Prestador Agregado', 'Confirmación');
                axios.post('tab_prestadores',params).then((response) => {
                  const nombrePrestador = response.data;
                  const apellidoPrestador = response.data;
                  const correoPrestador = response.data;
                  const ubicacionPrestador = response.data;
                  const telefonoPrestador = response.data;
                  const contrasenaPrestador = response.data;
                  const disponibilidadSeleccionada = response.data;
                  const serviciosAgregados = response.data;
                  const categoriasAgregadas = response.data;
                  this.$emit('new',nombrePrestador);
                  this.$emit('new',apellidoPrestador);
                  this.$emit('new',correoPrestador);
                  this.$emit('new',ubicacionPrestador);
                  this.$emit('new',telefonoPrestador);
                  this.$emit('new',disponibilidadSeleccionada);
                  this.$emit('new',contrasenaPrestador);
                  this.$emit('new',serviciosAgregados);
                  this.$emit('new',categoriasAgregadas);
                });
                

             
                


            },
            AgregarServicio(){
              this.categoriasAgregadas[this.cantidadCategoriasAgregadas] = this.categoriaSeleccionada;
              this.cantidadCategoriasAgregadas = this.cantidadCategoriasAgregadas+1;
              console.log(this.categoriasAgregadas);


              this.serviciosAgregados[this.cantidadServiciosAgregados] = this.servicioSeleccionado;
              this.cantidadServiciosAgregados = this.cantidadServiciosAgregados+1;
              console.log(this.serviciosAgregados);
                
            },
            getServiciosCategorias(){
              axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
            },
            getServicio(){
              
            }
        }
    }
</script>


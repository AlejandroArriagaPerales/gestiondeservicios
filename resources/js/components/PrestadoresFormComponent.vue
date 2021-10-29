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
              

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" class="form-control" placeholder="Apellidos" v-model="apellidoPrestador">
                    </div>
                  </div>
                </div>
               

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Correo Electrónico</label>
                      <input type="email" class="form-control" placeholder="Correo Electrónico" v-model="correoPrestador">
                    </div>
                  </div>
                </div>

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control" placeholder="Dirección" v-model="ubicacionPrestador">
                    </div>
                  </div>
                </div>

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Teléfono</label>
                      <input type="tel" class="form-control" placeholder="Teléfono" v-model="telefonoPrestador">
                    </div>
                  </div>
                </div>

                <div class="espacio">
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

                
                <div class="espacio">
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

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Contraseña</label>
                      <input type="password" class="form-control" placeholder="Contraseña" v-model="contrasenaPrestador">
                    </div>
                  </div>
                </div>
                  
                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Confirmar Contraseña</label>
                      <input type="password" class="form-control" placeholder="Confirmar Contraseña" >
                    </div>
                  </div>
                </div>

                <div class="espacio"></div>

                <table class="tabla">
                  <tr>
                    <td>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Categoria</label>
                              <v-select  v-model="categoriaSeleccionada" label="nombre" :options="tab_categorias"  :reduce="nombre => nombre.id" :searchable="true"   @input="getServiciosCategorias()">
                              </v-select>
                            </div>        
                    </td>
                    <td>      
                            <div class="form-group">
                              <label for="exampleInputEmail1">Servicio</label>

                              <v-select  v-model="servicioSeleccionado" label="nombre"  :options="tab_servicios_modificada" :reduce="nombre => nombre.id"  :searchable="true" >
                              </v-select>
                            </div>               
                    </td>
                    <td>
                            <button class="buttontabla"  v-on:click.prevent="AgregarServicio()">Aceptar</button>   
                             
                    </td>
                  </tr>
                </table>

                <br>  
                <br>     
                <br><br>
                <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Nombre Categoria
                      </th>
                      <th>
                        Nombre Servicio
                      </th>
                      <th>
                        Acción
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      <!--
                      <tr  v-for="(serviciosAgregado) in serviciosAgregados" :key="serviciosAgregado"> 
                       
                       

                      </tr>
                      -->

                      <tr v-for="(serviciosCategoria,index) in serviciosCategorias" :key="index"  >
                       <td>
                        
                         {{tab_categorias[serviciosCategoria.categoria-1].nombre}}
                         
                        </td>
                        <td>
                          {{tab_servicios[serviciosCategoria.servicio-1].nombre}}
                        </td>
                        <td>
                           <button class="btn btn-success" style="background: #AD290B"  v-on:click.prevent="Eliminar(index)">Eliminar</button>
                        </td>
                       
                      </tr>
                        
                      
                    </tbody>
                </table>
                <br>
                <br>
                <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Guardar">
              </form>
            </div>
</template>

<script src="https://unpkg.com/vue-swal"></script>
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
                categoriaSeleccionada: '',
                servicioSeleccionado: '',
                disponibilidadSeleccionada: '',
                tab_categorias: [],
                tab_servicios: [],
                serviciosAgregados: [],
                cantidadServiciosAgregados: 0,
                categoriasAgregadas: [],
                cantidadCategoriasAgregadas: 0,
                tab_servicios_modificada: [],
                serviciosAgregadosModificados: [],
                categoriasAgregadasModificadas: [],
                
                serviciosCategorias:[
                ],
                categoria: '',
                servicio: '',
                
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
                  Vue.swal("Prestador Agregado", "", "success");
                  location.reload();
                });
                

             
                


            },
            AgregarServicio(){
              
            this.tab_servicios_modificada = this.tab_servicios.filter(tab_servicio => tab_servicio.categoria_id == this.categoriaSeleccionada );

            this.categoriasAgregadas[this.cantidadCategoriasAgregadas] = this.categoriaSeleccionada;
            this.cantidadCategoriasAgregadas = this.cantidadCategoriasAgregadas+1;  

            this.serviciosAgregados[this.cantidadServiciosAgregados] = this.servicioSeleccionado;
            this.cantidadServiciosAgregados = this.cantidadServiciosAgregados+1;

            this.serviciosCategorias.push({ categoria: this.categoriaSeleccionada, servicio: this.servicioSeleccionado});
              
            console.log(this.serviciosCategorias);

            

              confirm('Servicio Agregado', 'Confirmación');
                
            },
            getServiciosCategorias(){
              axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
              this.tab_servicios_modificada = this.tab_servicios.filter(tab_servicio => tab_servicio.categoria_id == this.categoriaSeleccionada );

              
            },
            Eliminar: function (posicion_id){
                this.serviciosCategorias.splice(posicion_id, 1);
                this.categoriasAgregadas.splice(posicion_id, 1);
                this.serviciosAgregados.splice(posicion_id, 1);
                
                this.tab_servicios_modificada = this.tab_servicios.filter(tab_servicio => tab_servicio.categoria_id == this.categoriaSeleccionada );
            }
        }
        
    }
    
</script>


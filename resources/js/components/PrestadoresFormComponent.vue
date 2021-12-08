<template>
    <div class="card-body">
              <form v-on:submit.prevent="validarImagen()" action="" >
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Nombre(s)</label>
                      <input id="nombre" type="text" class="form-control" placeholder="Nombre(s)" v-model="nombrePrestador" required="required">
                      
                    </div>
                  </div>
                </div>
              

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" class="form-control" placeholder="Apellidos" v-model="apellidoPrestador" required="required">
                    </div>
                  </div>
                </div>
               

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Correo Electrónico</label>
                      <input type="email" class="form-control" placeholder="Correo Electrónico" v-model="correoPrestador" required="required">
                    </div>
                  </div>
                </div>

                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Teléfono</label>
                      <input type="tel" class="form-control" placeholder="Teléfono" v-model="telefonoPrestador" pattern="[0-9]{10}" title="El número telefónico contiene solo 10 dígitos" required="required">
                    </div>
                  </div>
                </div>
                
                
                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Seleccione una imagen</label>
                      <br>
                      <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()"/>
                    </div>
                  </div>
                </div>
                
             
                

                
                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Disponiblidad</label>
                      <select class="form-control" v-model="disponibilidadSeleccionada" required="required" >
                        <option :value="1">Disponible</option>
                        <option :value="0">No Disponible</option>
                      </select>
                    </div>
                  </div>
                </div>

                 
              <div id="msg"></div>
              
              <!-- Mensajes de Verificación -->
              <div id="error" class="alert alert-danger ocultar" role="alert">
                  Las Contraseñas no coinciden, vuelve a intentar.
              </div>
                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Contraseña</label>
                      <input id="password" type="password" class="form-control" placeholder="Contraseña" v-model="contrasenaPrestador" required="required">
                    </div>
                  </div>
                </div>
                  
                <div class="espacio">
                  <div class="">
                    <div class="form-group">
                      <label>Confirmar Contraseña</label>
                      <input id="confirm-password" type="password" class="form-control" placeholder="Confirmar Contraseña" required="required" v-model="contrasenaConfirmar" :rules="[(contrasenaPrestador === contrasenaConfirmar) || 'Password must match']">
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
                <input style="width: 120px; height: 50px; background:#F96332; color:white" class="buttons" type="submit" name="" value="Guardar">
              </form>
            </div>
</template>

<script src="https://unpkg.com/vue-swal"></script>
<script>

import axios from "axios";
    export default {
      async mounted(){
        await this.getDatos();
      },
        data(){
          
            return {
                nombrePrestador: '',
                apellidoPrestador: '',
                correoPrestador: '',
                telefonoPrestador: '',
                contrasenaPrestador: '',
                contrasenaConfirmar: '',
                categoriaSeleccionada: '',
                servicioSeleccionado: '',
                imagenPrestador: '',
                disponibilidadSeleccionada: '',
                tab_categorias: [],
                tab_servicios: [],
                tab_prestadores: [],
                serviciosAgregados: [],
                cantidadServiciosAgregados: 0,
                categoriasAgregadas: [],
                cantidadCategoriasAgregadas: 0,
                tab_servicios_modificada: [],
                serviciosAgregadosModificados: [],
                categoriasAgregadasModificadas: [],
                serviciosCategorias:[],
                encontrado: 0,
                categoria: '',
                servicio: '',
                image: '',
                file: '',
                recibidoPHP: '',
                archivo: '',
                idPrestadorImagen: 0,
                nombrePrestadorImagen: ''
                
            }
            
            
        },
        methods: {
          async getDatos(){
            await axios.get('tab_prestadores').then(res => this.tab_prestadores = res.data);
            await axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
            await axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
          },
          async guardarImagen(){
                let formData = new FormData();
                var self = this;
                await self.newPrestador();
                await self.getDatos();

                if (this.tab_prestadores.length==0) {
                  this.idPrestadorImagen = 1;                  
                  
                }else{
                  let cantidadPrestadores = this.tab_prestadores.length; 
                  this.idPrestadorImagen = this.tab_prestadores[cantidadPrestadores-1].id + 1;
                  
                }
                this.nombrePrestadorImagen = this.nombrePrestador;
                let nombreImagenPrestador = this.idPrestadorImagen+"_"+this.nombrePrestadorImagen;

                var blob = file.files[0].slice(0, file.files[0].size, 'image/png'); 
                var newFile = new File([blob], nombreImagenPrestador+'.png', {type: 'image/png'});
                formData.append('file', newFile);




                

                axios.post('php/subirImagenesPrestadores.php',
                    formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                  }
                ).then(response => {
                  
                });

                Vue.swal("Guardando prestador, porfavor espere...", "", "success");   
                setTimeout(function(){
                  
                },2000);

                

               

      },
        validarImagen(){
            let respuesta = null;
            let formData = new FormData();
            var self = this;
            formData.append('file', this.file);
            
  
            axios.post('php/validarImagenesPrestadores.php',
                formData,
                {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
              }
            ).then(response => {
              respuesta = response.data;
              return respuesta;
            });
            


            setTimeout(function(){
              this.recibidoPHP = respuesta;
              if (this.recibidoPHP=='error') {
              Vue.swal("Imagen no válida", "", "error");
              }else{
              
              self.guardarImagen();

              }
            },20);
            
            
              
              


            
          },
  
          onChangeFileUpload(){
            this.file = this.$refs.file.files[0];
          },
          newPrestador(){
            var pass1 = document.getElementById('password');
            var pass2 = document.getElementById('confirm-password');              
              
            if (pass1.value != pass2.value) {
              document.getElementById("error").classList.add("mostrar");
            }else{
                for (let i = 0; i < this.tab_prestadores.length; i++) {
                  if(this.tab_prestadores[i].correo == this.correoPrestador){
                    this.encontrado=1;
                  } 
                }
                if (this.encontrado==1) {
                  Vue.swal("Prestador ya existente", "", "error");
                  this.encontrado=0;
                }else{
                  
                  document.getElementById("error").classList.add("ocultar");

                const params = {
                    nombrePrestador: this.nombrePrestador,
                    apellidoPrestador: this.apellidoPrestador,
                    correoPrestador: this.correoPrestador,
                    telefonoPrestador: this.telefonoPrestador,
                    contrasenaPrestador: this.contrasenaPrestador,
                    disponibilidadSeleccionada: this.disponibilidadSeleccionada,
                    serviciosAgregados: this.serviciosAgregados,
                    categoriasAgregadas: this.categoriasAgregadas

                };
                
                
                axios.post('tab_prestadores',params).then((response) => {
                  const nombrePrestador = response.data;
                  const apellidoPrestador = response.data;
                  const correoPrestador = response.data;
                  const telefonoPrestador = response.data;
                  const contrasenaPrestador = response.data;
                  const disponibilidadSeleccionada = response.data;
                  const serviciosAgregados = response.data;
                  const categoriasAgregadas = response.data;
                  this.$emit('new',nombrePrestador);
                  this.$emit('new',apellidoPrestador);
                  this.$emit('new',correoPrestador);
                  this.$emit('new',telefonoPrestador);
                  this.$emit('new',disponibilidadSeleccionada);
                  this.$emit('new',contrasenaPrestador);
                  this.$emit('new',serviciosAgregados);
                  this.$emit('new',categoriasAgregadas);
                  setTimeout(function(){
                    //location.reload();
                  },100);
                });

            

                }
            }

             
                


            },
            AgregarServicio(){
              
            this.tab_servicios_modificada = this.tab_servicios.filter(tab_servicio => tab_servicio.categoria_id == this.categoriaSeleccionada );

            this.categoriasAgregadas[this.cantidadCategoriasAgregadas] = this.categoriaSeleccionada;
            this.cantidadCategoriasAgregadas = this.cantidadCategoriasAgregadas+1;  

            this.serviciosAgregados[this.cantidadServiciosAgregados] = this.servicioSeleccionado;
            this.cantidadServiciosAgregados = this.cantidadServiciosAgregados+1;

            this.serviciosCategorias.push({ categoria: this.categoriaSeleccionada, servicio: this.servicioSeleccionado});
            Vue.swal("Servicio Agregado", "", "success");
                
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


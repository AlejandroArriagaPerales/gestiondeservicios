<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newCliente()">

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Nombre(s)</label>
                      <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreCliente" required="required">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" class="form-control" placeholder="Apellidos" v-model="apellidoCliente" required="required">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Registro Federal de Contribuyentes (RFC)</label>
                      <input type="text" class="form-control" placeholder="RFC" v-model="rfcCliente" required="required">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Direccion</label>
                      <input type="text" class="form-control" placeholder="Direccion" v-model="direccionCliente" required="required">
                    </div>
                  </div>
                </div>

                <div id="error" class="alert alert-danger ocultar" role="alert">
                  Las Contraseñas no coinciden, vuelve a intentar.
              </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Contraseña</label>
                      <input id="password" type="password" class="form-control" placeholder="Contraseña" v-model="contrasenaCliente" required="required">
                    </div>
                  </div>
                </div>
                    
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Confirmar Contraseña</label>
                      <input id="confirm-password" type="password" class="form-control" placeholder="Confirmar Contraseña" v-model="contrasenaConfirmar" required="required">
                    </div>
                  </div>
                </div>
                <div></div>
                <table class="tabla">
                  <tr>
                    <td>
                      <label>Selecciona tus metodos de pago</label>
                            <div class="form-group">
                              
                              <v-select  v-model="PagosSeleccionado" label="nombre"  :options="tab_metodopagos" :reduce="nombre => nombre.id"  :searchable="true" >
                              </v-select>
                            </div>        
                    </td>
                    
                    <td>
                            <button class="buttontabla" v-on:click.prevent="AgregarMetodoPago()">Aceptar</button>    
                    </td>
                  </tr>
                </table>

                <br><br>
                <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Metodo de Pago
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

                      <tr v-for="(pagosAgregado,index) in PagosAgregadosTabla" :key="index"  >
                       <td>
                        {{tab_metodopagos[pagosAgregado.nombre - 1 ].nombre}}  
                        </td>
                        
                        <td>
                           <button class="btn btn-success" style="background: #AD290B"  v-on:click.prevent="Eliminar(index)">Eliminar</button>
                        </td>
                       
                      </tr>
                        
                      
                    </tbody>
                </table>
                <br>
                <input style="width: 120px; height: 50px; background:#F96332; color:white" class="buttons" type="submit" name="" value="Agregar">
                              
              </form>
            </div>
</template>

<script>
import axios from "axios";
    export default {
       created(){
        axios.get('tab_metodopagos').then(response => this.tab_metodopagos = response.data);
        axios.get('tab_clientes').then(response => this.tab_clientes = response.data);
      },
        data(){
          
            return {
                nombreCliente: '',
                apellidoCliente: '',
                rfcCliente: '',
                contrasenaCliente: '',
                direccionCliente: '',
                PagosSeleccionado: '',
                contrasenaConfirmar: '',
                cantidadPagosAgregados: 0,
                idClienteAgregado: [],
                PagosAgregados: [],
                PagosAgregadosTabla: [],
                nombre: '',
                tab_metodopagos: [],
                tab_clientes: [],
                encontrado: 0             
            }
            
        },
        mounted() {
            
        },
        methods: {
            newCliente(){
              var pass1 = document.getElementById('password');
              var pass2 = document.getElementById('confirm-password');  
              
              if (pass1.value != pass2.value) {
              document.getElementById("error").classList.add("mostrar");
              }else{
                for (let i = 0; i < this.tab_clientes.length; i++) {
                  if(this.tab_clientes[i].rfc == this.rfcCliente){
                    this.encontrado=1;
                  } 
                }
                if (this.encontrado==1) {
                  Vue.swal("Cliente ya existente", "", "error");
                  this.encontrado=0;
                  
                }else{
                  
                  document.getElementById("error").classList.add("ocultar");
              
                const params = {
                    nombreCliente: this.nombreCliente,
                    apellidoCliente: this.apellidoCliente,
                    rfcCliente: this.rfcCliente,
                    contrasenaCliente: this.contrasenaCliente,
                    direccionCliente: this.direccionCliente,
                    PagosAgregados: this.PagosAgregados
                };
                this.nombreCliente='';
                this.apellidoCliente='';
                this.rfcCliente='';
                this.contrasenaCliente='';
                this.direccionCliente='';
                this.contrasenaConfirmar="";
                
                
                axios.post('tab_clientes',params).then((response) => {
                  const nombreCliente = response.data;
                  const apellidoCliente = response.data;
                  const rfcCliente = response.data;
                  const contrasenaCliente = response.data;
                  const direccionCliente = response.data;
                  const PagosAgregados = response.data;
                  
                  this.$emit('new',nombreCliente);
                  this.$emit('new',apellidoCliente);
                  this.$emit('new',rfcCliente);
                  this.$emit('new',contrasenaCliente);
                  this.$emit('new',direccionCliente);
                  this.$emit('new',PagosAgregados);
                  Vue.swal("Guardando cliente, porfavor espere...", "", "success");   
                  setTimeout(function(){
                    location.reload();
                  },1500);
                });
                }
              }

                

                
                
                
                

                
            },
            AgregarMetodoPago(){
                this.PagosAgregadosTabla.push({ nombre: this.PagosSeleccionado});
                this.PagosAgregados[this.cantidadPagosAgregados] = this.PagosSeleccionado;
                this.cantidadPagosAgregados = this.cantidadPagosAgregados+1;
                Vue.swal("Metodo de Pago Agregado", "", "success");
            },
            Eliminar: function (posicion_id){
                this.PagosAgregados.splice(posicion_id, 1);
               
            }

        }
    }
</script>





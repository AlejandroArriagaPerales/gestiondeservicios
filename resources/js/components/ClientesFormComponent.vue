<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newCliente()">

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Nombre(s)</label>
                      <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreCliente">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Apellidos</label>
                      <input type="text" class="form-control" placeholder="Apellidos" v-model="apellidoCliente">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Registro Federal de Contribuyentes (RFC)</label>
                      <input type="text" class="form-control" placeholder="RFC" v-model="rfcCliente">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Direccion</label>
                      <input type="text" class="form-control" placeholder="Direccion" v-model="direccionCliente">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Contraseña</label>
                      <input type="password" class="form-control" placeholder="Contraseña" v-model="contrasenaCliente" >
                    </div>
                  </div>
                </div>
                    
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Confirmar Contraseña</label>
                      <input type="password" class="form-control" placeholder="Confirmar Contraseña">
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
                <br>
                <br>
                <input style="width: 120px; height: 50px; background:#F96332;" class="buttons" type="submit" name="" value="Agregar">
                              
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
                cantidadPagosAgregados: 0,
                idClienteAgregado: [],
                PagosAgregados: [],
                tab_metodopagos: [],
                tab_clientes: []             
            }
            
        },
        mounted() {
            console.log('Component mounted.')
            
        },
        methods: {
            newCliente(){
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
                  Vue.swal("Cliente Agregado", "", "success");
                  
                });

                

                
                
                
                

                
            },
            AgregarMetodoPago(){
                this.PagosAgregados[this.cantidadPagosAgregados] = this.PagosSeleccionado;
                this.cantidadPagosAgregados = this.cantidadPagosAgregados+1;
                confirm('Metodo de Pago Preparado', 'Confirmación');
            }

        }
    }
</script>





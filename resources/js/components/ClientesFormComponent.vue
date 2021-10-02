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

                <br>
                <input style="width: 120px; height: 50px; background:#F96332;" class="buttons" type="submit" name="" value="Agregar">
                              
              </form>
            </div>
</template>

<script>
    export default {
        data(){
            return {
                nombreCliente: '',
                apellidoCliente: '',
                rfcCliente: '',
                contrasenaCliente: ''             
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
                    contrasenaCliente: this.contrasenaCliente
                    
                };
                this.nombreCliente='';
                this.apellidoCliente='';
                this.rfcCliente='';
                this.contrasenaCliente='';
                confirm('Cliente Agregado', 'Confirmación');
                axios.post('tab_clientes',params).then((response) => {
                  const nombreCliente = response.data;
                  const apellidoCliente = response.data;
                  const rfcCliente = response.data;
                  const contrasenaCliente = response.data;
                  this.$emit('new',nombreCliente);
                  this.$emit('new',apellidoCliente);
                  this.$emit('new',rfcCliente);
                  this.$emit('new',contrasenaCliente);
                });
                
            }
        }
    }
</script>





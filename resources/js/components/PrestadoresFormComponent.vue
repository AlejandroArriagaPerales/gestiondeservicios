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

                <br>
                <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">
                        
              </form>
            </div>
</template>

<script>
    export default {
        data(){
            return {
                nombrePrestador: '',
                apellidoPrestador: '',
                correoPrestador: '',
                ubicacionPrestador: '',
                telefonoPrestador: '',
                contrasenaPrestador: ''
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
                    contrasenaPrestador: this.contrasenaPrestador
                };
                this.nombrePrestador='';
                this.apellidoPrestador='';
                this.correoPrestador='';
                this.ubicacionPrestador='';
                this.telefonoPrestador='';
                this.contrasenaPrestador='';
                axios.post('tab_prestadores',params).then((response) => {
                  const nombrePrestador = response.data;
                  const apellidoPrestador = response.data;
                  const correoPrestador = response.data;
                  const ubicacionPrestador = response.data;
                  const telefonoPrestador = response.data;
                  const contrasenaPrestador = response.data;
                  this.$emit('new',nombrePrestador);
                  this.$emit('new',apellidoPrestador);
                  this.$emit('new',correoPrestador);
                  this.$emit('new',ubicacionPrestador);
                  this.$emit('new',telefonoPrestador);
                  this.$emit('new',contrasenaPrestador);
                });
             
                
            }
        }
    }
</script>


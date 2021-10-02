<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newContactoProveedor()">

                <div class="form-group">
                  <label>Selecciona un Proveedor</label>

                    <select class="form-control" v-on="Recibido()" v-model="proveedorSeleccionado" >
                        <option :value="tab_proveedore.id" v-for="(tab_proveedore) in tab_proveedores" :key="tab_proveedore.id" >
                          {{tab_proveedore.nombre}}
                        </option>
                    </select>

                     

                </div>

                <br>

                <div class="form-group">
                  <label>Nombre(s)</label>
                  <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreContactoProveedor">
                </div>

                <div class="form-group">
                  <label>Correo Electrónico</label>
                  <input type="mail" class="form-control" placeholder="Correo" v-model="correoContactoProveedor">
                </div>

                <div class="form-group">
                  <label>Número Teléfono</label>
                  <input type="tel" class="form-control" placeholder="Telefóno" v-model="telefonoContactoProveedor">
                </div>
 
                <br>
                <br>
                    
                <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">

                <br>  
              </form>
              <!--
                <div v-for="tab_categoria in tab_categorias" v-bind:key="tab_categoria.id">
                    {{tab_categorias}}
                </div>
              -->
              
            </div>

            
</template>

<script>

  import axios from "axios";
  
    export default {
      created(){
        axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
      },
        data(){
            return {
                nombreContactoProveedor: '',
                correoContactoProveedor: '',
                telefonoContactoProveedor: '',
                proveedorSeleccionado: '',
                tab_proveedores: []
            }
            
        },
        mounted() {
            
        },
        methods: {
            newContactoProveedor(){
                const params = {
                    nombreContactoProveedor: this.nombreContactoProveedor,
                    correoContactoProveedor: this.correoContactoProveedor,
                    telefonoContactoProveedor: this.telefonoContactoProveedor,
                    proveedorSeleccionado: this.proveedorSeleccionado
                };
                this.nombreContactoProveedor='';
                this.correoContactoProveedor='';
                this.telefonoContactoProveedor='';
                this.proveedorSeleccionado='';
                confirm('Contacto Agregado', 'Confirmación');
                axios.post('tab_contactos',params).then((response) => {
                  const proveedorSeleccionado = response.data;
                  const nombreContactoProveedor = response.data;
                  const correoContactoProveedor = response.data;
                  const telefonoContactoProveedor = response.data;
                  
                  this.$emit('new',nombreContactoProveedor);
                  this.$emit('new',correoContactoProveedor);
                  this.$emit('new',telefonoContactoProveedor);
                  this.$emit('new',proveedorSeleccionado);
                });
             
                
            },
            Recibido(){
              
              
            }
        }
    }
</script>


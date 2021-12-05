<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newContactoProveedor()">

                <div class="form-group">
                  <label>Selecciona un Proveedor</label>

                    <v-select  v-model="proveedorSeleccionado" label="nombre"  :options="tab_proveedores" :reduce="nombre => nombre.id"  :searchable="true" >
                    </v-select>

                     

                </div>

                <br>

                <div class="form-group">
                  <label>Nombre(s)</label>
                  <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreContactoProveedor" required="required">
                </div>

                <div class="form-group">
                  <label>Correo Electrónico</label>
                  <input type="mail" class="form-control" placeholder="Correo" v-model="correoContactoProveedor" required="required">
                </div>

                <div class="form-group">
                  <label>Teléfono</label>
                  <input type="tel" class="form-control" placeholder="Telefóno" v-model="telefonoContactoProveedor" pattern="[0-9]{10}" title="El número telefónico contiene solo 10 dígitos" required="required">
                </div>
 
                <br>
                <br>
                    
                <input style="width: 120px; height: 50px; background:#F96332; color:white" class="buttons" type="submit" name="" value="Agregar">

                <br>  
              </form>
              
            </div>

            
</template>

<script>

  import axios from "axios";
  
    export default {
      created(){
        axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
        axios.get('tab_contactos').then(response => this.tab_contactos = response.data);
        
      },
        data(){
            return {
                nombreContactoProveedor: '',
                correoContactoProveedor: '',
                telefonoContactoProveedor: '',
                proveedorSeleccionado: '',
                tab_proveedores: [],
                tab_contactos: [],
                encontrado: 0
            }
            
        },
        mounted() {
            
        },
        methods: {
            newContactoProveedor(){
              for (let i = 0; i < this.tab_contactos.length; i++) {
                  if(this.tab_contactos[i].correo == this.correoContactoProveedor){
                    this.encontrado=1;
                  } 
                }
              if (this.encontrado==1) {
                  Vue.swal("Contacto ya existente", "", "error");
                  this.encontrado=0;
                  
              }else{
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
                axios.post('tab_contactos',params).then((response) => {
                  const proveedorSeleccionado = response.data;
                  const nombreContactoProveedor = response.data;
                  const correoContactoProveedor = response.data;
                  const telefonoContactoProveedor = response.data;
                  
                  this.$emit('new',nombreContactoProveedor);
                  this.$emit('new',correoContactoProveedor);
                  this.$emit('new',telefonoContactoProveedor);
                  this.$emit('new',proveedorSeleccionado);
                  Vue.swal("Contacto de Proveedor Agregado", "", "success");
                  setTimeout(function(){
                    location.reload();
                  },1500);
                });
              }
             
                
            },
            Recibido(){
              
              
            }
        }
    }
</script>


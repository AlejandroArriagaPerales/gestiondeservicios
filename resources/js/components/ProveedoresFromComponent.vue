<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="validarImagen()">
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Nombre de la Empresa</label>
                      <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreProveedor" required="required">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control" placeholder="Dirección" v-model="direccionProveedor" required="required">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Registro Federal de Contribuyentes (RFC)</label>
                      <input type="text" class="form-control" placeholder="RFC" v-model="rfcProveedor" required="required">
                    </div>
                  </div>
                </div>
              
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Teléfono</label>
                      <input type="tel" class="form-control" placeholder="Teléfono" v-model="telefonoProveedor" pattern="[0-9]{10}" title="El número telefónico contiene solo 10 dígitos" required="required">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Correo Electrónico</label>
                      <input type="email" class="form-control" placeholder="Correo Electrónico" v-model="correoProveedor" required="required">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Seleccione una imagen</label>
                      <br>
                      <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()"/>
                    </div>
                  </div>
                </div>

                <br>
                <input style="width: 120px; height: 50px; background:#F96332; color:white" class="buttons" type="submit" name="" value="Agregar">
                        
              </form>
            </div>
</template>

<script>
    export default {
      async mounted(){
        await this.getDatos();
      },
        data(){
            return {
                nombreProveedor: '',
                apellidoProveedor: '',
                direccionProveedor: '',
                rfcProveedor: '',
                telefonoProveedor: '',
                correoProveedor: '',
                tab_proveedores: [],
                encontrado: 0,
                file: '',
                recibidoPHP: '',
                archivo: '',
                idProveedorImagen: 0,
                nombreProveedorImagen: '',
                nombreImagenProveedor: '',
                logoProveedor: ''
            }
            
        },
        methods: {
          async getDatos(){
            await axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
          },
          async guardarImagen(){
                let formData = new FormData();
                var self = this;
                await self.newProveedor();
                await self.getDatos();

                

                var blob = file.files[0].slice(0, file.files[0].size, 'image/png'); 
                var newFile = new File([blob], this.nombreImagenProveedor+'.png', {type: 'image/png'});
                formData.append('file', newFile);                

                axios.post('php/subirImagenesProveedores.php',
                    formData,
                    {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                  }
                ).then(response => {
                  
                });

                Vue.swal("Guardando proveedor, porfavor espere...", "", "success");   
                setTimeout(function(){
                  location.reload();
                },2000);

                

               

      },
        validarImagen(){
            let respuesta = null;
            let formData = new FormData();
            var self = this;
            formData.append('file', this.file);
            
  
            axios.post('php/validarImagenesProveedores.php',
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
            newProveedor(){

              if (this.tab_proveedores.length==0) {
                  this.idProveedorImagen = 1;                  
                  
                }else{
                  let cantidadProveedores = this.tab_proveedores.length; 
                  this.idProveedorImagen = this.tab_proveedores[cantidadProveedores-1].id + 1;
                  
                }
                this.nombreProveedorImagen = this.nombreProveedor;
                this.nombreImagenProveedor = this.idProveedorImagen+"_"+this.nombreProveedorImagen;


              for (let i = 0; i < this.tab_proveedores.length; i++) {
                  if(this.tab_proveedores[i].rfc == this.rfcProveedor){
                    this.encontrado=1;
                  } 
                }
              if (this.encontrado==1) {
                  Vue.swal("Proveedor ya existente", "", "error");
                  this.encontrado=0;
                  
              }else{
                const params = {
                    nombreProveedor: this.nombreProveedor,
                    apellidoProveedor: this.apellidoProveedor,
                    direccionProveedor: this.direccionProveedor,
                    rfcProveedor: this.rfcProveedor,
                    telefonoProveedor: this.telefonoProveedor,
                    correoProveedor: this.correoProveedor,
                    logoProveedor: 'http://167.99.139.12/images/proveedores/'+this.nombreImagenProveedor+".png"
                };
               
                axios.post('tab_proveedores',params).then((response) => {
                  const nombreProveedor = response.data;
                  const apellidoProveedor = response.data;
                  const direccionProveedor = response.data;
                  const rfcProveedor = response.data;
                  const telefonoProveedor = response.data;
                  const correoProveedor = response.data;
                  const logoProveedor = response.data;
                  this.$emit('new',nombreProveedor);
                  this.$emit('new',apellidoProveedor);
                  this.$emit('new',direccionProveedor);
                  this.$emit('new',rfcProveedor);
                  this.$emit('new',telefonoProveedor);
                  this.$emit('new',correoProveedor);
                  this.$emit('new',logoProveedor);
                  setTimeout(function(){
                  },100);
                });
              }
                
            }
        }
    }
</script>


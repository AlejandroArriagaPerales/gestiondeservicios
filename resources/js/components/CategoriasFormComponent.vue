<template>
    <div class="card-body">
                <form action="" v-on:submit.prevent="validarImagen()">
                        
                  <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreCategoria" required="required">
                  </div>
                  <div class="form-group">
                    <label>Costo de la visita</label>
                    <input type="number" class="form-control" placeholder="Costo" v-model="costoVisitaCategoria" required="required">
                  </div>
                  <div class="form-group">
                    <label>Seleccione una imagen</label>
                    <br>
                    <input type="file" id="file" ref="file" v-on:change="onChangeFileUpload()"/>
                  </div>
                
                  
       
                  <br>
                  <input style="width: 120px; height: 50px; background:#F96332; color:white" class="buttons" type="submit" name="" value="Agregar">
                  <br>
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
                nombreCategoria: '',
                costoVisitaCategoria: '',
                tab_categorias: [],
                encontrado: 0,
                file: '',
                recibidoPHP: '',
                archivo: '',
                idCategoriaImagen: 0,
                nombreCategoriaImagen: '',
                nombreImagenCategoria: '',
                iconoCategoria: ''
            }
            
        },
        methods: {
          async getDatos(){
            await axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
          },
          async guardarImagen(){
                let formData = new FormData();
                var self = this;
                await self.newCategoria();
                await self.getDatos();

                

                var blob = file.files[0].slice(0, file.files[0].size, 'image/png'); 
                var newFile = new File([blob], this.nombreImagenCategoria+'.png', {type: 'image/png'});
                formData.append('file', newFile);

                axios.post('php/subirImagenesCategorias.php',
                      formData,
                      {
                      headers: {
                          'Content-Type': 'multipart/form-data'
                      }
                    }
                ).then(response => {
                    
                });
                
                Vue.swal("Guardando categoría, porfavor espere...", "", "success");                
                setTimeout(function(){
                  location.reload();
                },2000);

                

               

      },
        validarImagen(){
            let respuesta = null;
            let formData = new FormData();
            var self = this;
            formData.append('file', this.file);
            
  
            axios.post('php/validarImagenesCategorias.php',
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
            newCategoria(){

              if (this.tab_categorias.length==0) {
                  this.idCategoriaImagen = 1;                  
                  
                }else{
                  let cantidadCategorias = this.tab_categorias.length; 
                  this.idCategoriaImagen = this.tab_categorias[cantidadCategorias-1].id + 1;
                  
                }
                this.nombreCategoriaImagen = this.nombreCategoria;
                this.nombreImagenCategoria = this.idCategoriaImagen+"_"+this.nombreCategoriaImagen;
              

              for (let i = 0; i < this.tab_categorias.length; i++) {
                  if(this.tab_categorias[i].nombre == this.nombreCategoria){
                    this.encontrado=1;
                  } 
                }
              if (this.encontrado==1) {
                  Vue.swal("Categoria ya existente", "", "error");
                  this.encontrado=0;
                  
              }else{
                const params = {
                    nombreCategoria: this.nombreCategoria,
                    costoVisitaCategoria: this.costoVisitaCategoria,
                    iconoCategoria: 'http://167.99.139.12/images/categorias/'+this.nombreImagenCategoria+".png"
                    
                };
                
                
                
                axios.post('tab_categorias',params).then((response) => {
                  const nombreCategoria = response.data;
                  const costoVisitaCategoria = response.data;
                  const iconoCategoria = response.data;
                  this.$emit('new',nombreCategoria);
                  this.$emit('new',costoVisitaCategoria);
                  this.$emit('new',iconoCategoria);
                  setTimeout(function(){
                  },100);
                });
              }
             
                
            }
        }
    }
</script>





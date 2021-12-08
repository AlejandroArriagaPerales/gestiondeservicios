<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newCategoriaProducto()">

                <div class="form-group">
                  <label>Selecciona un proveedor</label>

                    <v-select  v-model="proveedorSeleccionado" label="nombre"  :options="tab_proveedores" :reduce="nombre => nombre.id"  :searchable="true" >
                    </v-select>

                     

                </div>

                <br>

                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" v-model="nombreCategoriaProducto" required="required">
                </div>
 
                <br>
                <br>
                    
                <input style="width: 120px; height: 50px; background:#F96332; color:white" class="buttons" type="submit" name="" value="Agregar">

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
        axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
      },
        data(){
            return {
                nombreCategoriaProducto: '',
                proveedorSeleccionado: '',
                tab_proveedores: [],
                tab_categoriaproductos: [],
                encontrado: 0
            }
            
        },
        mounted() {
            
        },
        methods: {
            newCategoriaProducto(){
              for (let i = 0; i < this.tab_categoriaproductos.length; i++) {
                  if(this.tab_categoriaproductos[i].nombre == this.nombreCategoriaProducto && this.tab_categoriaproductos[i].proveedore_id == this.proveedorSeleccionado){
                    this.encontrado=1;
                  } 
              }
              if (this.encontrado==1) {
                  Vue.swal("Categoria de producto ya existente", "", "error");
                  this.encontrado=0;
                  
              }else{
                const params = {
                    nombreCategoriaProducto: this.nombreCategoriaProducto,
                    proveedorSeleccionado: this.proveedorSeleccionado
                };
                this.nombreCategoriaProducto='';
                this.proveedorSeleccionado='';
                axios.post('tab_categoriaproductos',params).then((response) => {
                  const nombreCategoriaProducto = response.data;
                  const proveedorSeleccionado = response.data;                  
                  this.$emit('new',nombreCategoriaProducto);
                  this.$emit('new',proveedorSeleccionado);
                  Vue.swal("Guardando categoría de producto, porfavor espere...", "", "success");   
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


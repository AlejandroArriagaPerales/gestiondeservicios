<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newProducto()">

              

                <table class="tabla">
                  <tr>
                    <td>
                            <div class="form-group">
                              <label>Proveedor</label>
                              <v-select  v-model="proveedorSeleccionado" label="nombre" :options="tab_proveedores"  :reduce="nombre => nombre.id" :searchable="true"   @input="getProveedorCategoria()">
                              </v-select>
                            </div>        
                    </td>
                    <td>      
                            <div class="form-group">
                              <label for="exampleInputEmail1">Categoria de Producto</label>


                              <v-select  v-model="categoriaProductoSeleccionada" label="nombre"  :options="tab_categoriaproductosmodificada" :reduce="nombre => nombre.id"  :searchable="true" >
                              </v-select>
                            </div>               
                    </td>
                  </tr>
                </table>

                <br>
               
                
                

                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" v-model="nombreProducto" required="required">
                </div>

                <div class="form-group">
                  <label>Precio</label>
                  <input type="number" class="form-control" placeholder="Precio" v-model="precioProducto" required="required">
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
        axios.get('tab_productos').then(response => this.tab_productos = response.data);
      },
        data(){
            return {
                nombreProducto: '',
                precioProducto: '',
                categoriaProductoSeleccionada: '',
                proveedorSeleccionado: '',
                tab_categoriaproductos: [],
                tab_proveedores: [],
                tab_categoriaproductosmodificada: [],
                tab_productos: [],
                encontrado: 0
            }
            
        },
        mounted() {
            
        },
        methods: {
            newProducto(){
              for (let i = 0; i < this.tab_productos.length; i++) {
                  if(this.tab_productos[i].nombre == this.nombreProducto && this.tab_productos[i].proveedore_id == this.proveedorSeleccionado){
                    this.encontrado=1;
                  } 
                }
              if (this.encontrado==1) {
                  Vue.swal("Producto ya existente", "", "error");
                  this.encontrado=0;
                  
              }else{
                const params = {
                    nombreProducto: this.nombreProducto,
                    precioProducto: this.precioProducto,
                    categoriaProductoSeleccionada: this.categoriaProductoSeleccionada,
                    proveedorSeleccionado: this.proveedorSeleccionado
                };
                this.nombreProducto='';
                this.precioProducto='';
                this.categoriaProductoSeleccionada='';
                this.proveedorSeleccionado='';
                axios.post('tab_productos',params).then((response) => {
                  const nombreProducto = response.data;
                  const precioProducto = response.data;
                  const categoriaProductoSeleccionada = response.data;     
                  const proveedorSeleccionado = response.data;                
                  this.$emit('new',nombreProducto);
                  this.$emit('new',precioProducto);
                  this.$emit('new',categoriaProductoSeleccionada);
                  this.$emit('new',proveedorSeleccionado);
                  Vue.swal("Producto Agregado", "", "success");
                  setTimeout(function(){
                    location.reload();
                  },1500);
                });
              }
             
                
            },
            getProveedorCategoria(){
              axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
              this.tab_categoriaproductosmodificada = this.tab_categoriaproductos.filter(tab_categoriaproducto => tab_categoriaproducto.proveedore_id == this.proveedorSeleccionado );
            },
        }
    }
</script>


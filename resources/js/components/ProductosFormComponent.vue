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
                    <td>
                            <button class="buttontabla" v-on:click.prevent="AgregarServicio()">Aceptar</button>   
                             
                    </td>
                  </tr>
                </table>

                <br>
                <br>
                <br>
                <br>
                

                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" v-model="nombreProducto">
                </div>

                <div class="form-group">
                  <label>Precio</label>
                  <input type="text" class="form-control" placeholder="Precio" v-model="precioProducto">
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
        axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
      },
        data(){
            return {
                nombreProducto: '',
                precioProducto: '',
                categoriaProductoSeleccionada: '',
                proveedorSeleccionado: '',
                tab_categoriaproductos: [],
                tab_proveedores: [],
                tab_categoriaproductosmodificada: []
            }
            
        },
        mounted() {
            
        },
        methods: {
            newProducto(){
                const params = {
                    nombreProducto: this.nombreProducto,
                    precioProducto: this.precioProducto,
                    categoriaProductoSeleccionada: this.categoriaProductoSeleccionada
                };
                this.nombreProducto='';
                this.precioProducto='';
                this.categoriaProductoSeleccionada='';
                axios.post('tab_productos',params).then((response) => {
                  const nombreProducto = response.data;
                  const precioProducto = response.data;
                  const categoriaProductoSeleccionada = response.data;                  
                  this.$emit('new',nombreProducto);
                  this.$emit('new',precioProducto);
                  this.$emit('new',categoriaProductoSeleccionada);
                  Vue.swal("Producto Agregado", "", "success");
                });
             
                
            },
            getProveedorCategoria(){
              axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
              this.tab_categoriaproductosmodificada = this.tab_categoriaproductos.filter(tab_categoriaproducto => tab_categoriaproducto.proveedore_id == this.proveedorSeleccionado );
            },
        }
    }
</script>


<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newProducto()">

                <div class="form-group">
                  <label>Selecciona una categoria de producto</label>

                    <select class="form-control" v-on="Recibido()" v-model="categoriaProductoSeleccionada" >
                        <option :value="tab_categoriaproducto.id" v-for="(tab_categoriaproducto) in tab_categoriaproductos" :key="tab_categoriaproducto.id" >
                          {{tab_categoriaproducto.nombre}}
                        </option>
                    </select>

                     

                </div>

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
        axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
      },
        data(){
            return {
                nombreProducto: '',
                precioProducto: '',
                categoriaProductoSeleccionada: '',
                tab_categoriaproductos: []
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
                confirm('Producto Agregado', 'Confirmación');
                axios.post('tab_productos',params).then((response) => {
                  const nombreProducto = response.data;
                  const precioProducto = response.data;
                  const categoriaProductoSeleccionada = response.data;                  
                  this.$emit('new',nombreProducto);
                  this.$emit('new',precioProducto);
                  this.$emit('new',categoriaProductoSeleccionada);
                });
             
                
            },
            Recibido(){
              
              
            }
        }
    }
</script>


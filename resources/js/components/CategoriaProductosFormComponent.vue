<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newCategoriaProducto()">

                <div class="form-group">
                  <label>Selecciona un proveedor</label>

                    <select class="form-control" v-on="Recibido()" v-model="proveedorSeleccionado" >
                        <option :value="tab_proveedore.id" v-for="(tab_proveedore) in tab_proveedores" :key="tab_proveedore.id" >
                          {{tab_proveedore.nombre}}
                        </option>
                    </select>

                     

                </div>

                <br>

                <div class="form-group">
                  <label>Nombre</label>
                  <input type="text" class="form-control" placeholder="Nombre" v-model="nombreCategoriaProducto">
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
                nombreCategoriaProducto: '',
                proveedorSeleccionado: '',
                tab_proveedores: []
            }
            
        },
        mounted() {
            
        },
        methods: {
            newCategoriaProducto(){
                const params = {
                    nombreCategoriaProducto: this.nombreCategoriaProducto,
                    proveedorSeleccionado: this.proveedorSeleccionado
                };
                this.nombreCategoriaProducto='';
                this.proveedorSeleccionado='';
                confirm('Categoria de Producto Agregado', 'Confirmación');
                axios.post('tab_categoriaproductos',params).then((response) => {
                  const nombreCategoriaProducto = response.data;
                  const proveedorSeleccionado = response.data;                  
                  this.$emit('new',nombreCategoriaProducto);
                  this.$emit('new',proveedorSeleccionado);
                });
             
                
            },
            Recibido(){
              
              
            }
        }
    }
</script>


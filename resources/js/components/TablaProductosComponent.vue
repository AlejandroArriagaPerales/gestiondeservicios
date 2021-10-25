<template>

    <div class="card-body">
              <div style="position:relative; float:right;" >           
                <table style="width: 180px; height: 30px;" class=".tablabotonespdf">
                        <tr>
                          <td>
                              <div class="form-group">
                                  <button style="width: 80px; height: 30px; background: red; font-weight: bold;" class="buttons" v-on:click.prevent="GenerarPDF()"><i class="fa-solid fa-download"></i> PDF</button>
                              </div>            
                          </td>
                          <td>      
                              <div class="form-group">
                                <button style="width: 80px; height: 30px; background: green; font-weight: bold;" class="buttons" v-on:click.prevent="GenerarXLS()"><i class="fa-solid fa-download"></i> XLS</button>
                              </div>                   
                          </td>
                  
                        </tr>
                </table>
              </div>  
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        ID
                      </th>
                      <th>
                        Nombre
                      </th>
                      <th>
                        Precio
                      </th>
                      <th>
                        Categoria Producto
                      </th>
                      <th>
                        Fecha de Actualizacion del Precio
                      </th>
                      <th>
                        Estatus
                      </th>
                      <th>
                        
                      </th>
                        
                  
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_producto,index) in tab_productos" :key="tab_producto.id" v-bind:style="tab_producto.estatus == '0' ? 'color: #CCCACA':''">
                        <td>
                          {{tab_producto.id}}
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="nombreActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_producto.nombre}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="precioActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_producto.precio}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                            <select class="form-control" v-model="categoriaProductoSeleccionadaActualizar" >
                                  <option :value="tab_categoriaproducto.id" v-for="(tab_categoriaproducto) in tab_categoriaproductos" :key="tab_categoriaproducto.id" >
                                    {{tab_categoriaproducto.nombre}}
                                  </option>
                            </select>
                          </span>
                           <span v-else>
                        
                                    {{tab_categoriaproductos[tab_productos[index].categoriaProducto_id - 1 ].nombre}}
                                      </span>
                          
                        </td>

                        <td>
                          {{tab_producto.updated_at}}
                        </td>

                        <td>
                          
                          <span v-if="tab_producto.estatus =='1'">
                            <button class="btn btn-success" style="background: #AD290B"  @click="Desactivar(index)">Desactivar</button>

                          </span> <span v-else>
                            <button  class="btn btn-success" style="background: #169344" @click="Activar(index) ">Activar</button>
                             </span> 
                             
                      
                        </td>

                        <td>

                          <span v-if="verActualizar && idActualizar == index">
                            <!--    Formulario para actualizar -->
                             <button  class="btn btn-success"  @click="Actualizar(index) ">Guardar</button>
                             
                          </span>
                           <span v-else>
                              <button class="btn btn-warning"  @click="verActualizar(index)">Editar</button>

                                      </span>

                         
                        </td>
                       
                      </tr>
                        
                      
                    </tbody>
                  </table>
                </div>
              </div>

            
</template>

<script>

  import axios from "axios";
  import jsPDF from 'jspdf';
    import 'jspdf-autotable';
    import XLSX from 'xlsx';
  
    export default {
      created(){
        axios.get('tab_productos').then(response => this.tab_productos = response.data);
        axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
      },
        data(){
            return {
              idActualizar: -1,
              identificador:'',
              nombreActualizar: '',
              precioActualizar: '',
              tab_productos: [],
              categoriaProductoSeleccionadaActualizar: '',
              estatusActualizar: '',
              tab_categoriaproductos: []
            }
            
        },
        mounted() {
            
        },
        methods: {
            GenerarPDF(){
                confirm('PDF Generandose', 'Confirmación');

                

                var vm = this
                var columns = [
                  {title: "ID", dataKey: "id"},
                  {title: "Nombre", dataKey: "nombre"},
                  {title: "Precio", dataKey: "precio"},
                  {title: "Categoria", dataKey: "categoriaProducto_id"},
                  {title: "FechaPrecio", dataKey: "created_at"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Productos', 40, 40);
                doc.autoTable(columns, this.tab_productos, {
                  margin: {top: 60},
                });
                doc.save('ReporteProductos.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_productos,
              {
                header: ['id','nombre','precio','categoriaProducto_id','created_at','updated_at']
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Precio'
              data['D1'].v = 'CategoriaProducto'              
              data['E1'].v = 'Fecha Creación'
              data['F1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteProductos'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_productos[posicion_id].id;
                
                this.nombreActualizar = this.tab_productos[posicion_id].nombre;
                this.precioActualizar = this.tab_productos[posicion_id].precio;
                this.categoriaProductoSeleccionadaActualizar = this.tab_productos[posicion_id].categoriaProducto_id;
                this.estatusActualizar = this.tab_clientes[posicion_id].estatus;
                
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    precioActualizar: this.precioActualizar,
                    categoriaProductoSeleccionadaActualizar: this.categoriaProductoSeleccionadaActualizar,
                    estatusActualizar: this.estatusActualizar
                };

                axios.put(`tab_productos/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const precioActualizar = response.data;
                  const categoriaProductoSeleccionadaActualizar = response.data;
                  const estatusActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',precioActualizar);
                  this.$emit('update',categoriaProductoSeleccionadaActualizar);
                  this.$emit('update',estatusActualizar);

                  
                  confirm('Producto Actualizado', 'Confirmación');

                });
                
                location.reload();
                /*
                this.nombreActualizar = this.pacientes[paciente_id].nombre;
                this.edadActualizar = this.pacientes[paciente_id].edad;
                // Mostramos el formulario
                this.formActualizar = true;
                */
            },
            Activar: function (posicion_id) {
                 
              
                this.identificador = this.tab_productos[posicion_id].id;
                this.nombreActualizar = this.tab_productos[posicion_id].nombre;
                this.precioActualizar = this.tab_productos[posicion_id].precio;
                this.categoriaProductoSeleccionadaActualizar = this.tab_productos[posicion_id].categoriaProducto_id;
                
              
                const params = {
                    estatusActualizar: '1',
                    nombreActualizar: this.nombreActualizar,
                    precioActualizar: this.precioActualizar,
                    categoriaProductoSeleccionadaActualizar: this.categoriaProductoSeleccionadaActualizar
                };

                axios.put(`tab_productos/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const precioActualizar = response.data;
                  const categoriaProductoSeleccionadaActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',precioActualizar);
                  this.$emit('update',categoriaProductoSeleccionadaActualizar);
                });
                location.reload();
                confirm('Producto Habilitado', 'Confirmación');


            },
            Desactivar: function (posicion_id) {
                 
              
                this.identificador = this.tab_productos[posicion_id].id;
                this.nombreActualizar = this.tab_productos[posicion_id].nombre;
                this.precioActualizar = this.tab_productos[posicion_id].precio;
                this.categoriaProductoSeleccionadaActualizar = this.tab_productos[posicion_id].categoriaProducto_id;
                
              
                const params = {
                    estatusActualizar: '0',
                    nombreActualizar: this.nombreActualizar,
                    precioActualizar: this.precioActualizar,
                    categoriaProductoSeleccionadaActualizar: this.categoriaProductoSeleccionadaActualizar
                };

                axios.put(`tab_productos/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const precioActualizar = response.data;
                  const categoriaProductoSeleccionadaActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',precioActualizar);
                  this.$emit('update',categoriaProductoSeleccionadaActualizar);
                });
                location.reload();
                confirm('Producto Deshabilitado', 'Confirmación');


            }
            
        }
    }
</script>







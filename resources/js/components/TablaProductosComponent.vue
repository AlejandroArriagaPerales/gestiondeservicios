<template>

    <div>

      <!-- Modal formulario -->
        <div class="modal fade" id="modalForm">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header bg-primary">
                <h5 class="modal-title">
                  <i class="fa fa-user-plus"></i> Editar
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input type="text" class="form-control"  placeholder="" required="" v-model="datosProducto.nombreModal">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="nombre">Precio</label>
                      <input type="text" class="form-control"  placeholder="" required="" v-model="datosProducto.precioModal">
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="nombre">Categoria</label>
                      <v-select  v-model="datosProducto.categoriaProductoModal" label="nombre" :options="tab_categoriaproductos"  :reduce="nombre => nombre.id" :searchable="true"></v-select>
                    </div>
                </div>
                

                
               
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" @click.prevent="editarProducto(datosProducto.idModal)" v-if="btnEditar">Editar Producto</button>
                </div>
              </form>
            </div>
          </div>
        </div>

                <br>
                <br>
                <br>

               
                <div>
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
                  <table id="example" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                    <thead>
                      <tr>
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
                      </tr>
                        
                  
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_producto,index) in tab_productos" :key="tab_producto.id" v-bind:style="tab_producto.estatus == '0' ? 'color: #CCCACA':''">
                        <td>
                          {{tab_producto.id}}
                        </td>

                        <td>
                          {{tab_producto.nombre}}                          
                        </td>

                        <td>
                          {{tab_producto.precio}}
                        </td>

                        <td>
                          {{tab_categoriaproductos[tab_productos[index].categoriaProducto_id - 1 ].nombre}}                           
                        </td>

                        <td>
                          {{fecha(tab_producto.updated_at)}}
                        </td>

                        <td>
                          
                          <span v-if="tab_producto.estatus =='1'">
                            <button class="btn btn-success" style="background: #AD290B"  @click="Desactivar(index)">Desactivar</button>

                          </span> <span v-else>
                            <button  class="btn btn-success" style="background: #169344" @click="Activar(index) ">Activar</button>
                             </span> 
                             
                      
                        </td>

                        <td>
                          <button class="btn btn-warning"  @click="abrirModalEditar(tab_producto)">Editar</button>
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
    import moment from 'moment';
  
    export default {
      async mounted(){
        await this.getDatos();
        await this.tabla();
      },
        data(){
            return {
              idActualizar: '',
              identificador:'',
              nombreActualizar: '',
              precioActualizar: '',
              categoriaProductoActualizar: '',
              tab_productos: [],
              categoriaProductoSeleccionadaActualizar: '',
              estatusActualizar: '',
              tab_categoriaproductos: [],
              datosProducto: {idModal:'', nombreModal:'', precioModal:'',categoriaProductoModal:'', estatusModal:''},
              btnEditar:false,
              idProductoEditar: ''
            }
            
        },
        methods: {
          fecha(fechaActualizacion){
            return moment(fechaActualizacion).format('L');
          },
          async getDatos(){
            await axios.get('tab_productos').then(response => this.tab_productos = response.data);
            await axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
          },
          tabla(){
             
            this.$nextTick(() => {
            $('#example').DataTable();
            });
          },
          abrirModalEditar(datos){
              this.datosProducto= {idModal: datos.id , nombreModal: datos.nombre, precioModal: datos.precio, categoriaProductoModal: datos.categoriaProducto_id, estatusModal: datos.estatus}
              this.btnEditar=true;
              this.idProductoEditar=datos.id;
              $('#modalForm').modal('show');
            },
          editarProducto(idProductoEditar){
            this.idActualizar = idProductoEditar;

            const params2 = {
              nombreActualizar: this.datosProducto.nombreModal,
              precioActualizar: this.datosProducto.precioModal,
              categoriaProductoActualizar: this.datosProducto.categoriaProductoModal
            }
            

            axios.put(`tab_productos/${this.idActualizar}`,params2).then((response) => {
                  
                  const nombreActualizar = response.data;  
                  const precioActualizar = response.data;
                  const categoriaProductoActualizar = response.data;                           
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',precioActualizar);
                  this.$emit('update',categoriaProductoActualizar);
            });
          
            $('#modalForm').modal('hide')
            Vue.swal("Producto Editado", "", "success");
            setTimeout(function(){
                    location.reload();
            },1500);
            
          }, 
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







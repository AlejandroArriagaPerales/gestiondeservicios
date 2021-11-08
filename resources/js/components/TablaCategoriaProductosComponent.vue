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
                          <input type="text" class="form-control"  placeholder="" required="" v-model="datosCategoriaProducto.nombreModal">
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <label for="nombre">Proveedor</label>
                          <v-select  v-model="datosCategoriaProducto.proveedorModal" label="nombre" :options="tab_proveedores"  :reduce="nombre => nombre.id" :searchable="true"></v-select>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                      <button type="submit" class="btn btn-primary" @click.prevent="editarCategoriaProducto(datosCategoriaProducto.idModal)" v-if="btnEditar">Editar Categoria de Producto</button>
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
                                    <button style="width: 80px; height: 30px; background: green; font-weight: bold;" class="buttons" v-on:click.prevent="GenerarXLS()"> <i class="fa-solid fa-download"></i>XLS</button>
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
                        Proveedor
                      </th>
                      <th>
                        
                      </th>
                      </tr>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_categoriaproducto,index) in tab_categoriaproductos" :key="tab_categoriaproducto.id">
                        <td>
                          {{tab_categoriaproducto.id}}
                        </td>

                        <td>                          
                          {{tab_categoriaproducto.nombre}}                          
                        </td>

                        <td>
                          {{tab_proveedores[tab_categoriaproductos[index].proveedore_id - 1 ].nombre}}
                        </td>

                        <td>
                          <button class="btn btn-warning"  @click="abrirModalEditar(tab_categoriaproducto)">Editar</button>
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
      async mounted(){
        await this.getDatos();
        await this.tabla();
      },
        data(){
            return {
              idActualizar: '',
              identificador:'',
              nombreActualizar: '',
              proveedorActualizar: '',
              tab_categoriaproductos: [],
              tab_proveedores: [],
              datosCategoriaProducto: {idModal:'', nombreModal:'', proveedorModal:''},
              btnEditar:false,
              idCategoriaProductoEditar: ''
            }
            
        },
        methods: {
          async getDatos(){
            await axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
            await axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
          },
          tabla(){
            this.$nextTick(() => {
            $('#example').DataTable();
            });
          },
          abrirModalEditar(datos){
              this.datosCategoriaProducto= {idModal: datos.id , nombreModal: datos.nombre, proveedorModal: datos.proveedore_id}
              this.btnEditar=true;
              this.idCategoriaProductoEditar=datos.id;
              $('#modalForm').modal('show');
            },
          editarCategoriaProducto(idCategoriaProductoEditar){
            this.idActualizar = idCategoriaProductoEditar;

            const params2 = {
              nombreActualizar: this.datosCategoriaProducto.nombreModal,
              proveedorActualizar: this.datosCategoriaProducto.proveedorModal
            }
            

            axios.put(`tab_categoriaproductos/${this.idActualizar}`,params2).then((response) => {
                  
                  const nombreActualizar = response.data;  
                  const proveedorActualizar = response.data;                           
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',proveedorActualizar);
            });
          
            $('#modalForm').modal('hide')
            Vue.swal("Categoria Editada", "", "success");
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
                  {title: "Proveedor", dataKey: "proveedore_id"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Categoria de Productos', 40, 40);
                doc.autoTable(columns, this.tab_categoriaproductos, {
                  margin: {top: 60},
                });
                doc.save('ReporteCategoriaProductos.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_categoriaproductos,
              {
                header: ['id','nombre','proveedore_id','created_at','updated_at'],
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Proveedor'
              data['D1'].v = 'Fecha Creación'
              data['E1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteCategoriaProductos'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_categoriaproductos[posicion_id].id;
                
                this.nombreActualizar = this.tab_categoriaproductos[posicion_id].nombre;
                this.proveedorSeleccionadoActualizar = this.tab_categoriaproductos[posicion_id].proveedore_id;
                
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    proveedorSeleccionadoActualizar: this.proveedorSeleccionadoActualizar
                };

                axios.put(`tab_categoriaproductos/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const proveedorSeleccionadoActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',proveedorSeleccionadoActualizar);

                  
                  confirm('Categoria del Producto Actualizada', 'Confirmación');

                });
                location.reload();
                /*
                this.nombreActualizar = this.pacientes[paciente_id].nombre;
                this.edadActualizar = this.pacientes[paciente_id].edad;
                // Mostramos el formulario
                this.formActualizar = true;
                */
            }
        }
    }
</script>










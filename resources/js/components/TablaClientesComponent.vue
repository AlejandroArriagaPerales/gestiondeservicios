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
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosCliente.nombreModal">
                  </div>
                  <div class="form-group">
                    <label for="email">Apellidos</label>
                    <input type="email" class="form-control" placeholder="" required="" v-model="datosCliente.apellidoModal">
                  </div>
                  <div class="form-group">
                    <label for="clave">RFC</label>
                    <input type="email" class="form-control"   placeholder="" v-model="datosCliente.rfcModal" >
                  </div>
                  <div class="form-group">
                    <label for="clave">Direccion</label>
                    <input type="text" class="form-control"  placeholder="" v-model="datosCliente.direccionModal" >
                  </div>
                  

                

                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" @click.prevent="editarCliente(datosCliente.idModal)" v-if="btnEditar">Editar Cliente</button>
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
                        Nombre(s)
                      </th>
                      <th>
                        Apellidos
                      </th>
                      <th>
                        RFC
                      </th>
                      <th>
                        Dirección
                      </th>
                      <th>
                        Estatus
                      </th>
                      <th>
                        Acciones
                      </th>
                      </tr>
                    </thead>
                   

                    <tbody>
                      
                      <tr v-for="(tab_cliente,index) in tab_clientes" :key="tab_cliente.id" v-bind:style="tab_cliente.estatus == '0' ? 'color: #CCCACA':''"  >
                        <td>
                            {{tab_cliente.id}}
                        </td>
      
                        <td>                  
                            {{tab_cliente.nombre}}     
                        </td>    

                        <td>                          
                            {{tab_cliente.apellido}}                     
                        </td>

                        <td>                           
                          {{tab_cliente.rfc}}                                      
                        </td>

                        <td>                            
                          {{tab_cliente.direccion}}                                     
                        </td>

                        <td>                          
                          <span v-if="tab_cliente.estatus =='1'">
                            <button class="btn btn-success" style="background: #AD290B"  @click="Desactivar(index)">Desactivar</button>
                          </span> <span v-else>
                            <button  class="btn btn-success" style="background: #169344" @click="Activar(index) ">Activar</button>
                             </span> 
                        </td>

                        <td>
                          <button class="btn btn-warning"  @click="abrirModalEditar(tab_cliente)">Editar</button>
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
              estatusActualizar: '',
              idActualizar: '',
              identificador:'',
              nombreActualizar: '',
              apellidoActualizar: '',
              rfcActualizar: '',
              direccionActualizar: '',
              estatusActualizar: '', 
              tab_clientes: [],
              datosCliente: {idModal:'', nombreModal:'', apellidoModal:'', rfcModal:'', direccionModal:'', estatusModal:''},
              btnEditar:false,
              idClienteEditar: ''
            }
            
        },
        methods: {
          tabla(){
            this.$nextTick(() => {
            $('#example').DataTable();
            });
          },
          async getDatos(){
            await axios.get('tab_clientes').then(response => this.tab_clientes = response.data);
          },
          editarCliente(idClienteEditar){
            this.idActualizar = idClienteEditar;
            console.log(this.idActualizar);

            const params2 = {
              nombreActualizar: this.datosCliente.nombreModal,
              apellidoActualizar: this.datosCliente.apellidoModal,
              rfcActualizar: this.datosCliente.rfcModal,
              direccionActualizar: this.datosCliente.direccionModal,
              estatusActualizar: this.datosCliente.estatusModal
            }
            

            axios.put(`tab_clientes/${this.idActualizar}`,params2).then((response) => {
                  
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const rfcActualizar = response.data;
                  const direccionActualizar = response.data;     
                  const estatusActualizar = response.data;           
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',estatusActualizar);

            });
          
            $('#modalForm').modal('hide')
            Vue.swal("Cliente Editado", "", "success");
            setTimeout(function(){
                    location.reload();
            },1500);
            
          },      
          abrirModalEditar(datos){
              this.datosCliente= {idModal: datos.id , nombreModal: datos.nombre, apellidoModal: datos.apellido, rfcModal: datos.rfc, direccionModal: datos.direccion, estatusModal: datos.estatus}
              this.btnEditar=true;
              this.idClienteEditar=datos.id;
              $('#modalForm').modal('show');
            },
          GenerarPDF(){
                confirm('PDF Generandose', 'Confirmación');

                

                var vm = this
                var columns = [
                  {title: "ID", dataKey: "id"},
                  {title: "Nombre", dataKey: "nombre"},
                  {title: "Apellidos", dataKey: "apellido"},
                  {title: "RFC", dataKey: "rfc"},
                  {title: "Dirección", dataKey: "direccion"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Clientes', 40, 40);
                doc.autoTable(columns, this.tab_clientes, {
                  margin: {top: 60},
                });
                doc.save('ReporteClientes.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_clientes,
              {
                header: ['id','nombre','apellido','rfc','direccion','contrasena','created_at','updated_at'],
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Apellidos'
              data['D1'].v = 'RFC'
              data['E1'].v = 'Dirección'
              data['F1'].v = 'Contraseña'
              data['G1'].v = 'Fecha Creación'
              data['H1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteClientes'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            Activar: function (posicion_id) {
                 
              
                this.identificador = this.tab_clientes[posicion_id].id;
                this.nombreActualizar = this.tab_clientes[posicion_id].nombre;
                this.apellidoActualizar = this.tab_clientes[posicion_id].apellido;
                this.rfcActualizar = this.tab_clientes[posicion_id].rfc;
                this.direccionActualizar = this.tab_clientes[posicion_id].direccion;
                
              
                const params = {
                    estatusActualizar: '1',
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    rfcActualizar: this.rfcActualizar,
                    direccionActualizar: this.direccionActualizar
                };

                axios.put(`tab_clientes/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const rfcActualizar = response.data;
                  const direccionActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',direccionActualizar);

                });
                
                Vue.swal("Cliente Habilitado", "", "success");
                setTimeout(function(){
                    location.reload();
                },1500);


            },
            Desactivar: function (posicion_id){
                
                
                this.identificador = this.tab_clientes[posicion_id].id;
                this.nombreActualizar = this.tab_clientes[posicion_id].nombre;
                this.apellidoActualizar = this.tab_clientes[posicion_id].apellido;
                this.rfcActualizar = this.tab_clientes[posicion_id].rfc;
                this.direccionActualizar = this.tab_clientes[posicion_id].direccion;
                
              
                const params = {
                    estatusActualizar: '0',
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    rfcActualizar: this.rfcActualizar,
                    direccionActualizar: this.direccionActualizar
                };

                axios.put(`tab_clientes/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const rfcActualizar = response.data;
                  const direccionActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',direccionActualizar);
                  Vue.swal("Cliente Deshabilitado", "", "warning");
                  setTimeout(function(){
                      location.reload();
                  },1500);

                  });
                  

                
            }
        }
    }
</script>










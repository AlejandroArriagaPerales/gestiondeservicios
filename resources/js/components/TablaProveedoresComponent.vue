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
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosProveeedor.nombreModal">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Direccion</label>
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosProveeedor.direccionModal">
                  </div>
                  <div class="form-group">
                    <label for="nombre">RFC</label>
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosProveeedor.rfcModal">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Teléfono</label>
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosProveeedor.telefonoModal">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Correo</label>
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosProveeedor.correoModal">
                  </div>
                  
                  

                

                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" @click.prevent="editarProveedor(datosProveeedor.idModal)" v-if="btnEditar">Editar Proveedor</button>
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
                        Direccion
                      </th>
                      <th>
                        RFC
                      </th>
                      <th>
                        Telefono
                      </th>
                      <th>
                        Correo
                      </th>
                      <th>
                        Logo
                      </th>
                      <th>
                        Estatus
                      </th>
                      <th>
                        
                      </th>
                      </tr>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_proveedore,index) in tab_proveedores" :key="tab_proveedore.id" v-bind:style="tab_proveedore.estatus == '0' ? 'color: #CCCACA':''">
                        <td>
                          {{tab_proveedore.id}}
                        </td>

                        <td>
                          {{tab_proveedore.nombre}}                                
                        </td>
                        
                        <td>
                          {{tab_proveedore.direccion}}                          
                        </td>

                        <td>
                          {{tab_proveedore.rfc}}
                        </td>

                        <td>                      
                          {{tab_proveedore.telefono}}                           
                        </td>

                        <td>
                          {{tab_proveedore.correo}}                          
                        </td>

                        <td>                          
                          {{tab_proveedore.logo}}
                        </td>

                        <td>
                          
                          <span v-if="tab_proveedore.estatus =='1'">
                            <button class="btn btn-success" style="background: #AD290B"  @click="Desactivar(index)">Desactivar</button>

                          </span> <span v-else>
                            <button  class="btn btn-success" style="background: #169344" @click="Activar(index) ">Activar</button>
                             </span> 
                             
                      
                        </td>

                        <td>
                           <button class="btn btn-warning"  @click="abrirModalEditar(tab_proveedore)">Editar</button>
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
              direccionActualizar: '',
              rfcActualizar: '',
              telefonoActualizar: '',
              correoActualizar: '',
              estatusActualizar: '',
              tab_proveedores: [],
              datosProveeedor: {idModal:'', nombreModal:'', direccionModal:'', rfcModal:'', telefonoModal:'', correoModal:'', estatusModal:''},
              btnEditar:false,
              idProveedorEditar: ''
            }
            
        },       
        methods: {
          async getDatos(){
            await axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
          },
          tabla(){
            this.$nextTick(() => {
            $('#example').DataTable();
            });
          },
          abrirModalEditar(datos){
              this.datosProveeedor= {idModal: datos.id , nombreModal: datos.nombre, direccionModal: datos.direccion, rfcModal: datos.rfc, telefonoModal: datos.telefono, correoModal: datos.correo, estatusModal: datos.estatus}
              this.btnEditar=true;
              this.idProveedorEditar=datos.id;
              $('#modalForm').modal('show');
            },
          editarProveedor(idProveedorEditar){
            this.idActualizar = idProveedorEditar;

            const params2 = {
              nombreActualizar: this.datosProveeedor.nombreModal,
              direccionActualizar: this.datosProveeedor.direccionModal,
              rfcActualizar: this.datosProveeedor.rfcModal,
              telefonoActualizar: this.datosProveeedor.telefonoModal,
              correoActualizar: this.datosProveeedor.correoModal,
              estatusActualizar: this.datosProveeedor.estatusModal
            }
            

            axios.put(`tab_proveedores/${this.idActualizar}`,params2).then((response) => {
                  
                  const nombreActualizar = response.data; 
                  const direccionActualizar = response.data;  
                  const rfcActualizar = response.data;  
                  const telefonoActualizar = response.data;  
                  const correoActualizar = response.data;  
                  const estatusActualizar = response.data;                              
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',estatusActualizar);
            });
          
            $('#modalForm').modal('hide')
            Vue.swal("Proveedor Editado", "", "success");
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
                  {title: "Direccion", dataKey: "direccion"},
                  {title: "RFC", dataKey: "rfc"},
                  {title: "Telefono", dataKey: "telefono"},
                  {title: "Correo", dataKey: "correo"},
                  {title: "Logo", dataKey: "logo"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Proveedores', 40, 40);
                doc.autoTable(columns, this.tab_proveedores, {
                  margin: {top: 60},
                });
                doc.save('ReporteProveedores.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_proveedores,
              {
                header: ['id','nombre','direccion','rfc','telefono','correo','logo','created_at','updated_at'],
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Dirección'
              data['D1'].v = 'RFC'
              data['E1'].v = 'Teléfono'
              data['F1'].v = 'Correo'
              data['G1'].v = 'Logo'
              data['H1'].v = 'Fecha de Registro'
              data['I1'].v = 'Fecha de Actualización'
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteProveedores'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_proveedores[posicion_id].id;
                
                this.nombreActualizar = this.tab_proveedores[posicion_id].nombre;
                this.direccionActualizar = this.tab_proveedores[posicion_id].direccion;
                this.rfcActualizar = this.tab_proveedores[posicion_id].rfc;
                this.telefonoActualizar = this.tab_proveedores[posicion_id].telefono;
                this.correoActualizar = this.tab_proveedores[posicion_id].correo;
                this.estatusActualizar = this.tab_proveedores[posicion_id].estatus;
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    direccionActualizar: this.direccionActualizar,
                    rfcActualizar: this.rfcActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    correoActualizar: this.correoActualizar,
                    estatusActualizar: this.estatusActualizar
                };

                axios.put(`tab_proveedores/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const direccionActualizar = response.data;
                  const rfcActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const correoActualizar = response.data;
                  const estatusActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',estatusActualizar);

                  
                  confirm('Proveedor Actualizado', 'Confirmación');

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
                 
              
                this.identificador = this.tab_proveedores[posicion_id].id;
                this.nombreActualizar = this.tab_proveedores[posicion_id].nombre;
                this.direccionActualizar = this.tab_proveedores[posicion_id].direccion;
                this.rfcActualizar = this.tab_proveedores[posicion_id].rfc;
                this.telefonoActualizar = this.tab_proveedores[posicion_id].telefono;
                this.correoActualizar = this.tab_proveedores[posicion_id].correo;
                
              
                const params = {
                    estatusActualizar: '1',
                    nombreActualizar: this.nombreActualizar,
                    direccionActualizar: this.direccionActualizar,
                    rfcActualizar: this.rfcActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    correoActualizar: this.correoActualizar
                };

                axios.put(`tab_proveedores/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const direccionActualizar = response.data;
                  const rfcActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const correoActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',correoActualizar);

                });
                location.reload();
                confirm('Proveedor Habilitado', 'Confirmación');


            },
            Desactivar: function (posicion_id) {
                 
              
                this.identificador = this.tab_proveedores[posicion_id].id;
                this.nombreActualizar = this.tab_proveedores[posicion_id].nombre;
                this.direccionActualizar = this.tab_proveedores[posicion_id].direccion;
                this.rfcActualizar = this.tab_proveedores[posicion_id].rfc;
                this.telefonoActualizar = this.tab_proveedores[posicion_id].telefono;
                this.correoActualizar = this.tab_proveedores[posicion_id].correo;
                
              
                const params = {
                    estatusActualizar: '0',
                    nombreActualizar: this.nombreActualizar,
                    direccionActualizar: this.direccionActualizar,
                    rfcActualizar: this.rfcActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    correoActualizar: this.correoActualizar
                };

                axios.put(`tab_proveedores/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const direccionActualizar = response.data;
                  const rfcActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const correoActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',correoActualizar);

                });
                location.reload();
                confirm('Proveedor Deshabilitado', 'Confirmación');


            }
        }
    }
</script>










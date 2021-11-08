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
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosContacto.nombreModal">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Correo</label>
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosContacto.correoModal">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Telefono</label>
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosContacto.telefonoModal">
                  </div>
                  <div class="form-group">
                    <label for="nombre">Proveedor</label>
                    <v-select  v-model="datosContacto.proveedorModal" label="nombre" :options="tab_proveedores"  :reduce="nombre => nombre.id" :searchable="true"></v-select>
                  </div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" @click.prevent="editarContacto(datosContacto.idModal)" v-if="btnEditar">Editar Contacto</button>
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
                        Correo
                      </th>
                      <th>
                        Telefono
                      </th>
                      <th>
                        Proveedor
                      </th>
                      <th>
                        
                      </th>
                      </tr>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_contacto,index) in tab_contactos" :key="tab_contacto.id">
                        <td>
                          {{tab_contacto.id}}
                        </td>

                        <td>
                          {{tab_contacto.nombre}}     
                        </td>

                        <td>
                          {{tab_contacto.correo}}                    
                        </td>

                        <td>
                          {{tab_contacto.telefono}}
                        </td>

                        <td>                       
                          {{tab_proveedores[tab_contactos[index].proveedore_id - 1 ].nombre}}
                        </td>

                        <td>
                          <button class="btn btn-warning"  @click="abrirModalEditar(tab_contacto)">Editar</button>
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
              correoActualizar: '',
              telefonoActualizar: '',
              proveedorActualizar:'',
              tab_contactos: [],
              proveedorSeleccionadoActualizar: '',
              tab_proveedores: [],              
              datosContacto: {idModal:'', nombreModal:'', correoModal:'', telefonoModal:'', proveedorModal:''},
              btnEditar:false,
              idContactoEditar: ''
            }
            
        },
        methods: {
          async getDatos(){
            await axios.get('tab_contactos').then(response => this.tab_contactos = response.data);
            await axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
          },
          tabla(){
            this.$nextTick(() => {
            $('#example').DataTable();
            });
          },
          abrirModalEditar(datos){
              this.datosContacto= {idModal: datos.id , nombreModal: datos.nombre, correoModal: datos.correo, telefonoModal: datos.telefono, proveedorModal: datos.proveedore_id}
              this.btnEditar=true;
              this.idContactoEditar=datos.id;
              $('#modalForm').modal('show');
            },
          editarContacto(idContactoEditar){
            this.idActualizar = idContactoEditar;

            const params2 = {
              nombreActualizar: this.datosContacto.nombreModal,
              correoActualizar: this.datosContacto.correoModal,
              telefonoActualizar: this.datosContacto.telefonoModal,
              proveedorActualizar: this.datosContacto.proveedorModal
            }
            

            axios.put(`tab_contactos/${this.idActualizar}`,params2).then((response) => {
                  const nombreActualizar = response.data;   
                  const correoActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const proveedorActualizar = response.data;                          
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',proveedorActualizar);
            });
          
            $('#modalForm').modal('hide')
            Vue.swal("Contacto Editado", "", "success");
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
                  {title: "Correo", dataKey: "correo"},
                  {title: "Telefono", dataKey: "telefono"},
                  {title: "Proveedor", dataKey: "proveedore_id"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Contactos', 40, 40);
                doc.autoTable(columns, this.tab_contactos, {
                  margin: {top: 60},
                });
                doc.save('ReporteContactos.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_contactos,
              {
                header: ['id','nombre','correo','telefono','proveedore_id','created_at','updated_at'],
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Correo'
              data['D1'].v = 'Telefono'
              data['E1'].v = 'Proveedor'            
              data['F1'].v = 'Fecha Creación'
              data['G1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReportePrestadores'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_contactos[posicion_id].id;
                
                this.nombreActualizar = this.tab_contactos[posicion_id].nombre;
                this.correoActualizar = this.tab_contactos[posicion_id].correo;
                this.telefonoActualizar = this.tab_contactos[posicion_id].telefono;
                this.proveedorSeleccionadoActualizar = this.tab_contactos[posicion_id].proveedore_id;
                
                
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    correoActualizar: this.correoActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    proveedorSeleccionadoActualizar: this.proveedorSeleccionadoActualizar
                };

                axios.put(`tab_contactos/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const correoActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const proveedorSeleccionadoActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',proveedorSeleccionadoActualizar);

                  
                  confirm('Contacto Actualizado', 'Confirmación');

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

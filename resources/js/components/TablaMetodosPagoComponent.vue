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
                        <input type="text" class="form-control"  placeholder="" required="" v-model="datosMetodoPago.nombreModal">
                      </div>
                  </div>
                  
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" @click.prevent="editarMetodoPago(datosMetodoPago.idModal)" v-if="btnEditar">Editar Metodo de Pago</button>
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
                        
                      </th>
                      </tr>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_metodopago,index) in tab_metodopagos" :key="tab_metodopago.id">
                        <td>
                          {{tab_metodopago.id}}
                        </td>

                        <td>
                          {{tab_metodopago.nombre}}
                        </td>

                        <td>
                          <button class="btn btn-warning"  @click="abrirModalEditar(tab_metodopago)">Editar</button>
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
              tab_metodopagos: [],
              datosMetodoPago: {idModal:'', nombreModal:''},
              btnEditar:false,
              idMetodoPagoEditar: ''
            }
            
        },
        methods: {
          async getDatos(){
            await axios.get('tab_metodopagos').then(response => this.tab_metodopagos = response.data);
          },
          tabla(){
            this.$nextTick(() => {
            $('#example').DataTable();  
            });
          },
          abrirModalEditar(datos){
              this.datosMetodoPago= {idModal: datos.id , nombreModal: datos.nombre}
              this.btnEditar=true;
              this.idMetodoPagoEditar=datos.id;
              $('#modalForm').modal('show');
            },
          editarMetodoPago(idMetodoPagoEditar){
            this.idActualizar = idMetodoPagoEditar;

            const params2 = {
              nombreActualizar: this.datosMetodoPago.nombreModal
            }
            

            axios.put(`tab_metodopagos/${this.idActualizar}`,params2).then((response) => {                  
                  const nombreActualizar = response.data;                                            
                  this.$emit('update',nombreActualizar);
                  
            });
          
            $('#modalForm').modal('hide')
            Vue.swal("Metodo de Pago Editado", "", "success");
            setTimeout(function(){
                    location.reload();
            },1500);
            
          }, 
            GenerarPDF(){
                Vue.swal("PDF Generado", "", "success");

                

                var vm = this
                var columns = [
                  {title: "ID", dataKey: "id"},
                  {title: "Nombre", dataKey: "nombre"}
                  
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Metodos de Pago', 40, 40);
                doc.autoTable(columns, this.tab_metodopagos, {
                  margin: {top: 60},
                });
                doc.save('ReporteMetodosPago.pdf');
             
                
            },
            GenerarXLS(){
              Vue.swal("Excel Generado", "", "success");
              let data = XLSX.utils.json_to_sheet(this.tab_metodopagos,
              {
                header: ['id','nombre','created_at','updated_at'],
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'          
              data['C1'].v = 'Fecha Creación'
              data['D1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteMetodosPago'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_metodopagos[posicion_id].id;
                
                this.nombreActualizar = this.tab_metodopagos[posicion_id].nombre;
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar
                };

                axios.put(`tab_metodopagos/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
          

                  this.$emit('update',nombreActualizar);
                

                  
                  confirm('Metodo de Pago Actualizado', 'Confirmación');

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

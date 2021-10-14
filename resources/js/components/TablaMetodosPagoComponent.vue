<template>

    <div class="card-body">

            <div style="position:relative; float:right;" >           
                <table style="width: 180px; height: 30px;" class=".tablabotonespdf">
                        <tr>
                          <td>
                              <div class="form-group">
                                  <button style="width: 80px; height: 30px; background: red; font-weight: bold;" class="buttons" v-on:click.prevent="GenerarPDF()">PDF</button>
                              </div>            
                          </td>
                          <td>      
                              <div class="form-group">
                                <button style="width: 80px; height: 30px; background: green; font-weight: bold;" class="buttons" v-on:click.prevent="GenerarXLS()">XLS</button>
                              </div>                   
                          </td>
                  
                        </tr>
                </table>
              </div>  
                <br>
                <br>
                <br>

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
                        
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_metodopago,index) in tab_metodopagos" :key="tab_metodopago.id">
                        <td>
                          {{tab_metodopago.id}}
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="nombreActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_metodopago.nombre}}
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
        axios.get('tab_metodopagos').then(response => this.tab_metodopagos = response.data);
      },
        data(){
            return {
              idActualizar: -1,
              identificador:'',
              nombreActualizar: '',
              tab_metodopagos: []
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

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
                        Nombre(s)
                      </th>
                      <th>
                        Apellidos
                      </th>
                      <th>
                        Correo Electrónico
                      </th>
                      <th>
                        Ubicación
                      </th>
                      <th>
                        Teléfono
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_prestadore) in tab_prestadores" :key="tab_prestadore.id">
                        <td>
                          {{tab_prestadore.id}}
                        </td>
                        <td>
                          {{tab_prestadore.nombre}}
                        </td>
                        <td>
                          {{tab_prestadore.apellido}}
                        </td>
                        <td>
                          {{tab_prestadore.correo}}
                        </td>
                        <td>
                          {{tab_prestadore.ubicacion}}
                        </td>
                        <td>
                          {{tab_prestadore.telefono}}
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
        axios.get('tab_prestadores').then(response => this.tab_prestadores = response.data);
      },
        data(){
            return {
                tab_prestadores: []
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
                  {title: "Apellidos", dataKey: "apellido"},
                  {title: "Correo", dataKey: "correo"},
                  {title: "Ubicación", dataKey: "ubicacion"},
                  {title: "Telefono", dataKey: "telefono"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Prestadores', 40, 40);
                doc.autoTable(columns, this.tab_prestadores, {
                  margin: {top: 60},
                });
                doc.save('ReportePrestadores.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_prestadores,
              {
                header: ['id','nombre','apellido','correo','ubicacion','telefono','disponibilidad','contrasena','created_at','updated_at'],
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Apellidos'
              data['D1'].v = 'Correo'
              data['E1'].v = 'Ubicación'
              data['F1'].v = 'Telefono'
              data['G1'].v = 'Disponibilidad'
              data['H1'].v = 'Contraseña'
              data['I1'].v = 'Fecha Creación'
              data['J1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReportePrestadores'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            }
        }
    }
</script>










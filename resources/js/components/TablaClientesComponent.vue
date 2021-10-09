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
                        RFC
                      </th>
                      <th>
                        Dirección
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_cliente) in tab_clientes" :key="tab_cliente.id">
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
        axios.get('tab_clientes').then(response => this.tab_clientes = response.data);
      },
        data(){
            return {
                tab_clientes: []
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

            }
        }
    }
</script>










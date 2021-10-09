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
                        Correo
                      </th>
                      <th>
                        Telefono
                      </th>
                      <th>
                        Proveedor
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_contacto) in tab_contactos" :key="tab_contacto.id">
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
                          {{tab_contacto.proveedore_id}}
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
        axios.get('tab_contactos').then(response => this.tab_contactos = response.data);
      },
        data(){
            return {
                tab_contactos: []
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

            }
        }
    }
</script>

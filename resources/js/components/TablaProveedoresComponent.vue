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
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_proveedore) in tab_proveedores" :key="tab_proveedore.id">
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
        axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
      },
        data(){
            return {
                tab_proveedores: []
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

            }
        }
    }
</script>










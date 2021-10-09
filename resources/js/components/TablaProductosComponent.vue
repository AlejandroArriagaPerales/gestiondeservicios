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
                        Precio
                      </th>
                      <th>
                        ID Categoria Producto
                      </th>
                      <th>
                        Fecha Creacion Precio
                      </th>
                        
                  
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_producto) in tab_productos" :key="tab_producto.id">
                        <td>
                          {{tab_producto.id}}
                        </td>
                        <td>
                          {{tab_producto.nombre}}
                        </td>
                        <td>
                          {{tab_producto.precio}}
                        </td>
                        <td>
                          {{tab_producto.categoriaProducto_id}}
                        </td>
                        <td>
                          {{tab_producto.created_at}}
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
        axios.get('tab_productos').then(response => this.tab_productos = response.data);
      },
        data(){
            return {
                tab_productos: []
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
                  {title: "Precio", dataKey: "precio"},
                  {title: "Categoria", dataKey: "categoriaProducto_id"},
                  {title: "FechaPrecio", dataKey: "created_at"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Productos', 40, 40);
                doc.autoTable(columns, this.tab_productos, {
                  margin: {top: 60},
                });
                doc.save('ReporteProductos.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_productos,
              {
                header: ['id','nombre','precio','categoriaProducto_id','created_at','updated_at']
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Precio'
              data['D1'].v = 'CategoriaProducto'              
              data['E1'].v = 'Fecha Creación'
              data['F1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteProductos'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            }
        }
    }
</script>







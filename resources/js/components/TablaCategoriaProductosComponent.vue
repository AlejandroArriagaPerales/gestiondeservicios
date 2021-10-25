<template>

    <div class="card-body">
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
                        Proveedor
                      </th>
                      <th>
                        
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_categoriaproducto,index) in tab_categoriaproductos" :key="tab_categoriaproducto.id">
                        <td>
                          {{tab_categoriaproducto.id}}
                        </td>
                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="nombreActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_categoriaproducto.nombre}}
                                      </span>
                          
                        </td>
                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                            <select class="form-control" v-model="proveedorSeleccionadoActualizar" >
                                <option :value="tab_proveedore.id" v-for="(tab_proveedore) in tab_proveedores" :key="tab_proveedore.id" >
                                  {{tab_proveedore.nombre}}
                                </option>
                            </select>
                          </span>
                           <span v-else>
                        
                                    
                                    {{tab_proveedores[tab_categoriaproductos[index].proveedore_id - 1 ].nombre}}
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
        axios.get('tab_categoriaproductos').then(response => this.tab_categoriaproductos = response.data);
        axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
      },
        data(){
            return {
              idActualizar: -1,
              identificador:'',
              nombreActualizar: '',
              tab_categoriaproductos: [],
              proveedorSeleccionadoActualizar: '',
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
                  {title: "Proveedor", dataKey: "proveedore_id"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Categoria de Productos', 40, 40);
                doc.autoTable(columns, this.tab_categoriaproductos, {
                  margin: {top: 60},
                });
                doc.save('ReporteCategoriaProductos.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_categoriaproductos,
              {
                header: ['id','nombre','proveedore_id','created_at','updated_at'],
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Proveedor'
              data['D1'].v = 'Fecha Creación'
              data['E1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteCategoriaProductos'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_categoriaproductos[posicion_id].id;
                
                this.nombreActualizar = this.tab_categoriaproductos[posicion_id].nombre;
                this.proveedorSeleccionadoActualizar = this.tab_categoriaproductos[posicion_id].proveedore_id;
                
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    proveedorSeleccionadoActualizar: this.proveedorSeleccionadoActualizar
                };

                axios.put(`tab_categoriaproductos/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const proveedorSeleccionadoActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',proveedorSeleccionadoActualizar);

                  
                  confirm('Categoria del Producto Actualizada', 'Confirmación');

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










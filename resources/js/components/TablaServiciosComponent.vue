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
                        ID Categoria
                      </th>
                      <th>
                        
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_servicio,index) in tab_servicios" :key="tab_servicio.id">
                        <td>
                          {{tab_servicio.id}}
                        </td>
                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="nombreActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_servicio.nombre}}
                                      </span>
                          
                        </td>
                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <select class="form-control" v-model="categoriaSeleccionadaActualizar" >
                                <option :value="tab_categoria.id" v-for="(tab_categoria) in tab_categorias" :key="tab_categoria.id" >
                                  {{tab_categoria.nombre}}
                                </option>
                            </select>
                          </span>
                           <span v-else>
                        
                                    {{tab_servicio.categoria_id}}
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
        axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
        axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
      },
        data(){
            return {
              idActualizar: -1,
              identificador:'',
              nombreActualizar: '',
              tab_servicios: [],
              categoriaSeleccionadaActualizar: '',
              tab_categorias: []
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
                  {title: "Categoria", dataKey: "categoria_id"}
                
                ];
                var doc = new jsPDF('p', 'pt');
                doc.text('Reporte de Servicios', 40, 40);
                doc.autoTable(columns, this.tab_servicios, {
                  margin: {top: 60},
                });
                doc.save('ReporteServicios.pdf');
             
                
            },
            GenerarXLS(){

              let data = XLSX.utils.json_to_sheet(this.tab_servicios,
              {
                header: ['id','nombre','categoria_id','created_at','updated_at']
                
              }
              )
              data['A1'].v = 'ID'
              data['B1'].v = 'Nombre'
              data['C1'].v = 'Categoria'            
              data['D1'].v = 'Fecha Creación'
              data['E1'].v = 'Fecha Actualización'
              
              
              
              const workbook = XLSX.utils.book_new()
              const filename = 'ReporteServicios'
              XLSX.utils.book_append_sheet(workbook, data, filename)
              XLSX.writeFile(workbook, `${filename}.xlsx`)

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_servicios[posicion_id].id;
                
                this.nombreActualizar = this.tab_servicios[posicion_id].nombre;
                this.categoriaSeleccionadaActualizar = this.tab_servicios[posicion_id].categoria_id;
                
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    categoriaSeleccionadaActualizar: this.categoriaSeleccionadaActualizar
                };

                axios.put(`tab_servicios/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const categoriaSeleccionadaActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',categoriaSeleccionadaActualizar);

                  
                  confirm('Servicio Actualizado', 'Confirmación');

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










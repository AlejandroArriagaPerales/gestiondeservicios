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
                      <th>
                        
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_contacto,index) in tab_contactos" :key="tab_contacto.id">
                        <td>
                          {{tab_contacto.id}}
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="nombreActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_contacto.nombre}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="correoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_contacto.correo}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="telefonoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_contacto.telefono}}
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
                        
                                    {{tab_contacto.proveedore_id}}
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
        axios.get('tab_contactos').then(response => this.tab_contactos = response.data);
        axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
      },
        data(){
            return {
              idActualizar: -1,
              identificador:'',
              nombreActualizar: '',
              correoActualizar: '',
              telefonoActualizar: '',
              tab_contactos: [],
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

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
                      <th>
                        Estatus
                      </th>
                      <th>
                        
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_prestadore, index) in tab_prestadores" :key="tab_prestadore.id" v-bind:style="tab_prestadore.estatus == '0' ? 'color: #CCCACA':''">
                       
                        <td>
                        {{tab_prestadore.id}}
                        </td>


                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="nombreActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_prestadore.nombre}}
                                      </span>

                        </td>


                        <td>
                            <span v-if="verActualizar && idActualizar == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="apellidoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                                  
                                    {{tab_prestadore.apellido}}
                                      </span>
                        </td>


                        <td>
                            <span v-if="verActualizar && idActualizar == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="correoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                               
                                     {{tab_prestadore.correo}}
                                      </span>
                        </td>


                        <td>
                            <span v-if="verActualizar && idActualizar == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="ubicacionActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                                   
                                    {{tab_prestadore.ubicacion}}
                                      </span>
                        </td>


                        <td>
                           <span v-if="verActualizar && idActualizar == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="telefonoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                                   
                                     {{tab_prestadore.telefono}}
                                      </span>

                         
                        </td>


                        <td>
                          
                          <span v-if="tab_prestadore.estatus =='1'">
                            <button class="btn btn-success" style="background: #AD290B"  @click="Desactivar(index)">Desactivar</button>

                          </span> <span v-else>
                            <button  class="btn btn-success" style="background: #169344" @click="Activar(index) ">Activar</button>
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
        axios.get('tab_prestadores').then(response => this.tab_prestadores = response.data);
      },
        data(){
            return {
               
                  idActualizar: -1,
                  identificador:'',
                  nombreActualizar: '',
                  apellidoActualizar: '',
                  correoActualizar: '',
                  ubicacionActualizar: '',
                  telefonoActualizar: '',
                  estatusActualizar: '',
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

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_prestadores[posicion_id].id;
                
                this.nombreActualizar = this.tab_prestadores[posicion_id].nombre;
                this.apellidoActualizar = this.tab_prestadores[posicion_id].apellido;
                this.correoActualizar = this.tab_prestadores[posicion_id].correo;
                this.ubicacionActualizar = this.tab_prestadores[posicion_id].ubicacion;
                this.telefonoActualizar = this.tab_prestadores[posicion_id].telefono;
                this.estatusActualizar = this.tab_prestadores[posicion_id].estatus;
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    correoActualizar: this.correoActualizar,
                    ubicacionActualizar: this.ubicacionActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    estatusActualizar: this.estatusActualizar
                };

                axios.put(`tab_prestadores/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const correoActualizar = response.data;
                  const ubicacionActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const estatusActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',ubicacionActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',estatusActualizar);

                  
                  confirm('Prestador Actualizado', 'Confirmación');

                });
                location.reload();
                /*
                this.nombreActualizar = this.pacientes[paciente_id].nombre;
                this.edadActualizar = this.pacientes[paciente_id].edad;
                // Mostramos el formulario
                this.formActualizar = true;
                */
            },
            Activar: function (posicion_id) {
                 
              
                this.identificador = this.tab_prestadores[posicion_id].id;
                this.nombreActualizar = this.tab_prestadores[posicion_id].nombre;
                this.apellidoActualizar = this.tab_prestadores[posicion_id].apellido;
                this.correoActualizar = this.tab_prestadores[posicion_id].correo;
                this.ubicacionActualizar = this.tab_prestadores[posicion_id].ubicacion;
                this.telefonoActualizar = this.tab_prestadores[posicion_id].telefono;
                
              
                const params = {
                    estatusActualizar: '1',
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    correoActualizar: this.correoActualizar,
                    ubicacionActualizar: this.ubicacionActualizar,
                    telefonoActualizar: this.telefonoActualizar
                };

                axios.put(`tab_prestadores/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const correoActualizar = response.data;
                  const ubicacionActualizar = response.data;
                  const telefonoActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',ubicacionActualizar);
                  this.$emit('update',telefonoActualizar);

                });
                location.reload();
                confirm('Prestador Habilitado', 'Confirmación');


            },
            Desactivar: function (posicion_id){
                
                
                this.identificador = this.tab_prestadores[posicion_id].id;
                this.nombreActualizar = this.tab_prestadores[posicion_id].nombre;
                this.apellidoActualizar = this.tab_prestadores[posicion_id].apellido;
                this.correoActualizar = this.tab_prestadores[posicion_id].correo;
                this.ubicacionActualizar = this.tab_prestadores[posicion_id].ubicacion;
                this.telefonoActualizar = this.tab_prestadores[posicion_id].telefono;
                
              
                const params = {
                    estatusActualizar: '0',
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    correoActualizar: this.correoActualizar,
                    ubicacionActualizar: this.ubicacionActualizar,
                    telefonoActualizar: this.telefonoActualizar
                };

                axios.put(`tab_prestadores/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const correoActualizar = response.data;
                  const ubicacionActualizar = response.data;
                  const telefonoActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',ubicacionActualizar);
                  this.$emit('update',telefonoActualizar);
                  location.reload();
                  confirm('Prestador Deshabilitado', 'Confirmación');

                });
                

                
            }
        }




    }
</script>










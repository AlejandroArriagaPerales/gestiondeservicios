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
                                <button style="width: 80px; height: 30px; background: green; font-weight: bold;" class="buttons" v-on:click.prevent="GenerarXLS()"><i class="fa-solid fa-download"></i> XLS</button>
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
                      <th>
                        Estatus
                      </th>
                      <th>
                        
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      
                      <tr v-for="(tab_cliente,index) in tab_clientes" :key="tab_cliente.id" v-bind:style="tab_cliente.estatus == '0' ? 'color: #CCCACA':''"  >
                       <!-- <span v-if="tab_cliente.estatus =='1'"> -->
                         
                        
                          
                          <td>
                            {{tab_cliente.id}}
                          </td>
      
                            <td>
                              <span v-if="verActualizar && idActualizar  == index">
                                <!--    Formulario para actualizar -->
                                <input v-model="nombreActualizar" type="text" class="form-control">
                              </span>
                              <span v-else>
                                        {{tab_cliente.nombre}}
                                          </span>
                            </td>



                        <td>
                           <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="apellidoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                                    {{tab_cliente.apellido}}
                                      </span>
                          
                        </td>


                        <td>
                           <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="rfcActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                                     {{tab_cliente.rfc}}
                                      </span>
                        </td>

                        <td>
                            <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="direccionActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                                    {{tab_cliente.direccion}}
                                      </span>
                        </td>

                        <td>
                          
                          <span v-if="tab_cliente.estatus =='1'">
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
        axios.get('tab_clientes').then(response => this.tab_clientes = response.data);
      },
        data(){
            return {
               estatusActualizar: '',
               idActualizar: -1,
               identificador:'',
               nombreActualizar: '',
               apellidoActualizar: '',
               rfcActualizar: '',
               direccionActualizar: '',
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

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_clientes[posicion_id].id;
                
                this.nombreActualizar = this.tab_clientes[posicion_id].nombre;
                this.apellidoActualizar = this.tab_clientes[posicion_id].apellido;
                this.rfcActualizar = this.tab_clientes[posicion_id].rfc;
                this.direccionActualizar = this.tab_clientes[posicion_id].direccion;
                this.estatusActualizar = this.tab_clientes[posicion_id].estatus;
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    rfcActualizar: this.rfcActualizar,
                    direccionActualizar: this.direccionActualizar,
                    estatusActualizar: this.estatusActualizar
                };

                axios.put(`tab_clientes/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const rfcActualizar = response.data;
                  const direccionActualizar = response.data;
                  const estatusActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',estatusActualizar);

                  
                  confirm('Cliente Actualizado', 'Confirmación');

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
                 
              
                this.identificador = this.tab_clientes[posicion_id].id;
                this.nombreActualizar = this.tab_clientes[posicion_id].nombre;
                this.apellidoActualizar = this.tab_clientes[posicion_id].apellido;
                this.rfcActualizar = this.tab_clientes[posicion_id].rfc;
                this.direccionActualizar = this.tab_clientes[posicion_id].direccion;
                
              
                const params = {
                    estatusActualizar: '1',
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    rfcActualizar: this.rfcActualizar,
                    direccionActualizar: this.direccionActualizar
                };

                axios.put(`tab_clientes/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const rfcActualizar = response.data;
                  const direccionActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',direccionActualizar);

                });
                location.reload();
                confirm('Cliente Habilitado', 'Confirmación');


            },
            Desactivar: function (posicion_id){
                
                
                this.identificador = this.tab_clientes[posicion_id].id;
                this.nombreActualizar = this.tab_clientes[posicion_id].nombre;
                this.apellidoActualizar = this.tab_clientes[posicion_id].apellido;
                this.rfcActualizar = this.tab_clientes[posicion_id].rfc;
                this.direccionActualizar = this.tab_clientes[posicion_id].direccion;
                
              
                const params = {
                    estatusActualizar: '0',
                    nombreActualizar: this.nombreActualizar,
                    apellidoActualizar: this.apellidoActualizar,
                    rfcActualizar: this.rfcActualizar,
                    direccionActualizar: this.direccionActualizar
                };

                axios.put(`tab_clientes/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const apellidoActualizar = response.data;
                  const rfcActualizar = response.data;
                  const direccionActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',apellidoActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',direccionActualizar);
                  location.reload();
                  confirm('Cliente Deshabilitado', 'Confirmación');

                });
                

                
            }
        }
    }
</script>










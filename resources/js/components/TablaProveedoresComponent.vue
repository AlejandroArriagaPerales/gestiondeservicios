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
                      <th>
                        Estatus
                      </th>
                      <th>
                        
                      </th>
                      
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_proveedore,index) in tab_proveedores" :key="tab_proveedore.id" v-bind:style="tab_proveedore.estatus == '0' ? 'color: #CCCACA':''">
                        <td>
                          {{tab_proveedore.id}}
                        </td>
                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="nombreActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_proveedore.nombre}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="direccionActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_proveedore.direccion}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="rfcActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_proveedore.rfc}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="telefonoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_proveedore.telefono}}
                                      </span>
                          
                        </td>

                        <td>
                          <span v-if="verActualizar && idActualizar  == index">
                            <!--    Formulario para actualizar -->
                             <input v-model="correoActualizar" type="text" class="form-control">
                          </span>
                           <span v-else>
                        
                                    {{tab_proveedore.correo}}
                                      </span>
                          
                        </td>

                        <td>
                          
                          {{tab_proveedore.logo}}
                        </td>

                        <td>
                          
                          <span v-if="tab_proveedore.estatus =='1'">
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
        axios.get('tab_proveedores').then(response => this.tab_proveedores = response.data);
      },
        data(){
            return {
              idActualizar: -1,
              identificador:'',
              nombreActualizar: '',
              direccionActualizar: '',
              rfcActualizar: '',
              telefonoActualizar: '',
              correoActualizar: '',
              estatusActualizar: '',
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

            },
            verActualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                
                this.idActualizar = posicion_id;
                this.identificador = this.tab_proveedores[posicion_id].id;
                
                this.nombreActualizar = this.tab_proveedores[posicion_id].nombre;
                this.direccionActualizar = this.tab_proveedores[posicion_id].direccion;
                this.rfcActualizar = this.tab_proveedores[posicion_id].rfc;
                this.telefonoActualizar = this.tab_proveedores[posicion_id].telefono;
                this.correoActualizar = this.tab_proveedores[posicion_id].correo;
                this.estatusActualizar = this.tab_proveedores[posicion_id].estatus;
                // Mostramos el formulario
                this. verActualizar = true;
            },
            Actualizar: function (posicion_id) {
                // Antes de mostrar el formulario de actualizar, rellenamos sus campos
                this.idActualizar = posicion_id;


                const params = {
                    nombreActualizar: this.nombreActualizar,
                    direccionActualizar: this.direccionActualizar,
                    rfcActualizar: this.rfcActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    correoActualizar: this.correoActualizar,
                    estatusActualizar: this.estatusActualizar
                };

                axios.put(`tab_proveedores/${this.identificador}`,params).then((response) => {
                  const nombreActualizar = response.data;
                  const direccionActualizar = response.data;
                  const rfcActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const correoActualizar = response.data;
                  const estatusActualizar = response.data;

                  this.$emit('update',nombreActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',correoActualizar);
                  this.$emit('update',estatusActualizar);

                  
                  confirm('Proveedor Actualizado', 'Confirmación');

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
                 
              
                this.identificador = this.tab_proveedores[posicion_id].id;
                this.nombreActualizar = this.tab_proveedores[posicion_id].nombre;
                this.direccionActualizar = this.tab_proveedores[posicion_id].direccion;
                this.rfcActualizar = this.tab_proveedores[posicion_id].rfc;
                this.telefonoActualizar = this.tab_proveedores[posicion_id].telefono;
                this.correoActualizar = this.tab_proveedores[posicion_id].correo;
                
              
                const params = {
                    estatusActualizar: '1',
                    nombreActualizar: this.nombreActualizar,
                    direccionActualizar: this.direccionActualizar,
                    rfcActualizar: this.rfcActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    correoActualizar: this.correoActualizar
                };

                axios.put(`tab_proveedores/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const direccionActualizar = response.data;
                  const rfcActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const correoActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',correoActualizar);

                });
                location.reload();
                confirm('Cliente Habilitado', 'Confirmación');


            },
            Desactivar: function (posicion_id) {
                 
              
                this.identificador = this.tab_proveedores[posicion_id].id;
                this.nombreActualizar = this.tab_proveedores[posicion_id].nombre;
                this.direccionActualizar = this.tab_proveedores[posicion_id].direccion;
                this.rfcActualizar = this.tab_proveedores[posicion_id].rfc;
                this.telefonoActualizar = this.tab_proveedores[posicion_id].telefono;
                this.correoActualizar = this.tab_proveedores[posicion_id].correo;
                
              
                const params = {
                    estatusActualizar: '0',
                    nombreActualizar: this.nombreActualizar,
                    direccionActualizar: this.direccionActualizar,
                    rfcActualizar: this.rfcActualizar,
                    telefonoActualizar: this.telefonoActualizar,
                    correoActualizar: this.correoActualizar
                };

                axios.put(`tab_proveedores/${this.identificador}`,params).then((response) => {
                  const estatusActualizar = response.data;
                  const nombreActualizar = response.data;
                  const direccionActualizar = response.data;
                  const rfcActualizar = response.data;
                  const telefonoActualizar = response.data;
                  const correoActualizar = response.data;
                  this.$emit('update',estatusActualizar);
                  this.$emit('update',nombreActualizar);
                  this.$emit('update',direccionActualizar);
                  this.$emit('update',rfcActualizar);
                  this.$emit('update',telefonoActualizar);
                  this.$emit('update',correoActualizar);

                });
                location.reload();
                confirm('Cliente Habilitado', 'Confirmación');


            }
        }
    }
</script>










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
                  <input type="text" v-model="buscar" placeholder="Buscar por categoria">
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
                        Categoria
                      </th>
                      <th>
                        Estatus
                      </th>
                      <th>
                        
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_prestadore, index) in datosFiltrados" :key="tab_prestadore.nombre" v-bind:style="tab_prestadore.estatus == '0' ? 'color: #CCCACA':''">
                       
                        <td>
                        {{tab_prestadore.idPrestador}}
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

                        <td >
                            
                            
                            {{tab_prestadore.categoria}}


                            
                            
                            
              
                        </td>


                        <td>
                         
                          <span v-if="tab_prestadore.estatus == '1'">
                            <button class="btn btn-success" style="background: #AD290B"  @click="Desactivar(tab_prestadore.idPrestador-1)">Desactivar</button>

                          </span> <span v-else>
                            <button  class="btn btn-success" style="background: #169344" @click="Activar(tab_prestadore.idPrestador-1) ">Activar</button>
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
        axios.get('tab_categoriaprestadorservicios').then(response => this.tab_prestadorescategorias = response.data);
        axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
        
        
        
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
                  tab_prestadores: [],
                  tab_prestadorescategorias: [],
                  tab_categorias: [],
                  buscar: '',
                  unionPrestadorCategoria: [],
                  id: '',
                  idPrestador: '',
                  nombre: '',
                  apellido: '',
                  correo: '',
                  ubicacion: '',
                  telefono: '',
                  estatus: '',
                  categoria: ''

                
            }
            
            
        },
        mounted() {
         
        

        },
        computed: {
          

          
          datosFiltrados: function(){
            
              this.unionPrestadorCategoria = [];
            
            for (let i = 0; i < this.tab_prestadorescategorias.length; i++) {
              var idRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).id;
              var nombreRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).nombre;
              var apellidoRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).apellido;
              var correoRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).correo;
              var ubicacionRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).ubicacion;
              var correoRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).correo;
              var telefonoRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).telefono;
              var estatusRecogido = this.tab_prestadores.find(x => x.id === this.tab_prestadorescategorias[i].prestador_id).estatus;
              var categoriaRecogida = this.tab_categorias.find(x => x.id === this.tab_prestadorescategorias[i].categoria_id).nombre;

              this.unionPrestadorCategoria.push({idPrestador: idRecogido, nombre: nombreRecogido, apellido: apellidoRecogido, correo: correoRecogido, 
              ubicacion: ubicacionRecogido, telefono: telefonoRecogido, estatus: estatusRecogido, categoria: categoriaRecogida})
          
              
            }
            console.log(this.unionPrestadorCategoria)

            

            
            return this.unionPrestadorCategoria.filter((tab_categorias) => {
              return tab_categorias.categoria.match(this.buscar);
              
            });
              

            
            
            
            
          }
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





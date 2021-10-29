<template>
      
    <div class="card-body">

      <!-- Modal formulario -->
      <div class="modal fade" id="modalForm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title">
                <i class="fa fa-user-plus"></i> Editar
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form>
              <div class="modal-body">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control"  placeholder="" required="" v-model="datosPrestador.nombreModal">
                  </div>
                  <div class="form-group">
                    <label for="email">Apellidos</label>
                    <input type="email" class="form-control" placeholder="" required="" v-model="datosPrestador.apellidoModal">
                  </div>
                  <div class="form-group">
                    <label for="clave">Correo Electrónico</label>
                    <input type="email" class="form-control"   placeholder="" v-model="datosPrestador.correoModal" >
                  </div>
                  <div class="form-group">
                    <label for="clave">Ubicacion</label>
                    <input type="text" class="form-control"  placeholder="" v-model="datosPrestador.ubicacionModal" >
                  </div>
                  <div class="form-group">
                    <label for="clave">Telefono</label>
                    <input type="text" class="form-control"  placeholder="" v-model="datosPrestador.telefonoModal" >
                  </div>

                  <table class="tabla">
                  <tr>
                    <td>
                            <div class="form-group">
                              <label for="exampleInputEmail1">Categoria</label>
                              <v-select  v-model="categoriaSeleccionada" label="nombre" :options="tab_categorias"  :reduce="nombre => nombre.id" :searchable="true"   @input="getServiciosCategorias()">
                              </v-select>
                            </div>        
                    </td>
                    <td>      
                            <div class="form-group">
                              <label for="exampleInputEmail1">Servicio</label>

                              <v-select  v-model="servicioSeleccionado" label="nombre"  :options="tab_servicios_modificada" :reduce="nombre => nombre.id"  :searchable="true" >
                              </v-select>
                            </div>               
                    </td>
                    <td>
                            <button class="buttontabla"  v-on:click.prevent="AgregarServicio()">Aceptar</button>   
                             
                    </td>
                  </tr>
                </table>
                  <br>  
                <br>     
                <br><br>

                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                        Nombre Categoria
                      </th>
                      <th>
                        Nombre Servicio
                      </th>
                      <th>
                        Acción
                      </th>
                      
                    </thead>
                   

                    <tbody>
                      <!--
                      <tr  v-for="(serviciosAgregado) in serviciosAgregados" :key="serviciosAgregado"> 
                       
                       

                      </tr>
                      -->

                      <tr v-for="(serviciosCategoria,index) in serviciosCategorias" :key="index"  >
                       <td>
                        
                         {{tab_categorias[serviciosCategoria.categoria-1].nombre}}
                         
                        </td>
                        <td>
                          {{tab_servicios[serviciosCategoria.servicio-1].nombre}}
                        </td>
                        <td>
                           <button class="btn btn-success" style="background: #AD290B"  v-on:click.prevent="Eliminar(index)">Eliminar</button>
                        </td>
                       
                      </tr>
                        
                      
                    </tbody>
                </table>


                

                  
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary" @click.prevent="editarPrestador(datosPrestador.idPrestadorModal)" v-if="btnEditar">Editar usuario</button>
              </div>
            </form>
          </div>
        </div>
      </div>



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
                      <tr v-for="(tab_prestadore, index) in datosFiltrados" :key="tab_prestadore.id" v-bind:style="tab_prestadore.estatus == '0' ? 'color: #CCCACA':''">
                       
                        <td>
                        {{tab_prestadore.idPrestador}}
                        </td>


                        <td>
                          
                        
                                    {{tab_prestadore.nombre}}
                                    
                               

                        </td>


                        <td>
                            
                        
                                  
                                    {{tab_prestadore.apellido}}
                                     
                        </td>


                        <td>
                           
                            
                               
                                     {{tab_prestadore.correo}}
                                      
                        </td>


                        <td>
                            
                           
                                   
                                    {{tab_prestadore.ubicacion}}
                                      
                        </td>


                        <td>
                           
                          
                                   
                                  {{tab_prestadore.telefono}}
                                    

                         
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
                           <button class="btn btn-warning"  @click="abrirModalEditar(tab_prestadore)">Editar</button>

                                    

                         
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
        axios.get('tab_categorias').then(response => this.tab_categorias = response.data);    
        axios.get('tab_categoriaprestadorservicios').then(response => this.tab_prestadorescategorias = response.data);
        axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
        
      },
      data(){
            return {
               
                idActualizar: -1,
                identificador:'',
                tab_prestadores: [],
                tab_prestadorescategorias: [],
                tab_categorias: [],
                tab_servicios: [],
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
                categoria: '',
                datosPrestador: {idModal:'', idPrestadorModal:'', nombreModal:'', apellidoModal:'', correoModal:'', ubicacionModal:'', telefonoModal:'', estatusModal:'', categoriaModal:''},
                btnEditar:false,
                idPrestadorEditar: '',
                categoriaSeleccionada: '',
                servicioSeleccionado: '',
                serviciosCategorias:[],
                categoria: '',
                servicio: '',
                tab_servicios_modificada: [],
                serviciosAgregadosModificados: [],
                categoriasAgregadasModificadas: [],
                serviciosAgregados: [],
                cantidadServiciosAgregados: 0,
                categoriasAgregadas: [],
                cantidadCategoriasAgregadas: 0,
                nombreActualizar: '',
                apellidoActualizar: '',
                correoActualizar: '',
                ubicacionActualizar: '',
                telefonoActualizar: '',
                estatusActualizar: '',
                idPrestadorAgregar: ''
                
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
        

            
           

            return this.unionPrestadorCategoria.filter((tab_categorias) => {
              return tab_categorias.categoria.match(this.buscar);
              
            });
                 
          }
        },
        methods: {
          editarPrestador(idPrestadorEditar){
            this.idActualizar = idPrestadorEditar;

            const params2 = {
              nombreActualizar: this.datosPrestador.nombreModal,
              apellidoActualizar: this.datosPrestador.apellidoModal,
              correoActualizar: this.datosPrestador.correoModal,
              ubicacionActualizar: this.datosPrestador.ubicacionModal,
              telefonoActualizar: this.datosPrestador.telefonoModal,
              estatusActualizar: this.datosPrestador.estatusModal
            }

            axios.put(`tab_prestadores/${this.idActualizar}`,params2).then((response) => {
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

            });

            for (let i = 0; i < this.tab_prestadorescategorias.length; i++) {
              if(this.tab_prestadorescategorias[i].prestador_id == this.idActualizar){
                var idPrestadorCategoria = this.tab_prestadorescategorias[i].id;
                axios.delete(`tab_categoriaprestadorservicios/${idPrestadorCategoria}`).then(() => {
                  this.$emit('delete');
                });

              }
              
            }
            console.log("Aqui llege; "+ this.serviciosCategorias)

            for (let i = 0; i < this.serviciosCategorias.length; i++) {
              this.serviciosAgregados[i]= this.serviciosCategorias[i].servicio;
              this.categoriasAgregadas[i]= this.serviciosCategorias[i].categoria;
              
            }


             const params = {
                    idPrestadorAgregar: idPrestadorEditar,
                    serviciosAgregados: this.serviciosAgregados,
                    categoriasAgregadas: this.categoriasAgregadas
                };
                this.nombrePrestador='';
                this.apellidoPrestador='';
                this.correoPrestador='';
                this.ubicacionPrestador='';
                this.telefonoPrestador='';
                this.contrasenaPrestador='';
                this.disponibilidadSeleccionada="";


            axios.post('tab_categoriaprestadorservicios',params).then((response) => {
  
                  const serviciosAgregados = response.data;
                  const categoriasAgregadas = response.data;
                  const idPrestadorAgregar = response.data
                  this.$emit('new',serviciosAgregados);
                  this.$emit('new',categoriasAgregadas);
                  this.$emit('new',idPrestadorAgregar);
                  
                });






          
            $('#modalForm').modal('hide')
            Vue.swal("Prestador Agregado", "", "success");
            location.reload();
            
          },
          AgregarServicio(){
              
            this.tab_servicios_modificada = this.tab_servicios.filter(tab_servicio => tab_servicio.categoria_id == this.categoriaSeleccionada );

            this.categoriasAgregadas[this.cantidadCategoriasAgregadas] = this.categoriaSeleccionada;
            this.cantidadCategoriasAgregadas = this.cantidadCategoriasAgregadas+1;  

            this.serviciosAgregados[this.cantidadServiciosAgregados] = this.servicioSeleccionado;
            this.cantidadServiciosAgregados = this.cantidadServiciosAgregados+1;

            this.serviciosCategorias.push({ categoria: this.categoriaSeleccionada, servicio: this.servicioSeleccionado});
              
            console.log(this.serviciosCategorias);

            

              confirm('Servicio Agregado', 'Confirmación');
                
          },
          getServiciosCategorias(){
              axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
              this.tab_servicios_modificada = this.tab_servicios.filter(tab_servicio => tab_servicio.categoria_id == this.categoriaSeleccionada );

              
          },        
          abrirModalEditar(datos){
              for (let i = this.serviciosCategorias.length; i >= 0; i--) {
                  this.serviciosCategorias.pop();

                }
              this.datosPrestador= {idModal: datos.id , idPrestadorModal: datos.idPrestador, nombreModal: datos.nombre, apellidoModal: datos.apellido, correoModal: datos.correo, ubicacionModal: datos.ubicacion, telefonoModal: datos.telefono, estatusModal: datos.estatus, categoriaModal: datos.categoria}
              this.btnEditar=true;
              this.idPrestadorEditar=datos.idPrestador;
              $('#modalForm').modal('show');
              for (let i = 0; i < this.tab_prestadorescategorias.length; i++) {
                if(this.tab_prestadorescategorias[i].prestador_id == datos.idPrestador){
                  var categoriaBuscada = this.tab_prestadorescategorias[i].categoria_id;
                  var servicioBuscado = this.tab_prestadorescategorias[i].servicio_id;
                  this.serviciosCategorias.push({ categoria: categoriaBuscada, servicio: servicioBuscado});  
                }               

               
                
              }
            },

          Eliminar: function (posicion_id){
                this.serviciosCategorias.splice(posicion_id, 1);

                /*
                this.categoriasAgregadas.splice(posicion_id, 1);
                this.serviciosAgregados.splice(posicion_id, 1);
                */
                
            },        
            
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





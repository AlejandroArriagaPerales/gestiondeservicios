<template>
    
    <div>

        <!-- Modal formulario -->
      <div class="modal fade" id="modalForm">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title">
                <i class="fa fa-user-plus"></i> Detalles
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div style="margin: auto;" class="col-md-11" >
            
            <!-- Datos del Modal -->
            <br>
            <h6><b>Nombre:</b> {{datosPrestador.nombreModal}} {{datosPrestador.apellidoModal}}</h6>
            <br>

            <table id="example2" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                    <thead>
                      <tr>
                      <th>
                        Categoria
                      </th>
                      <th>
                        Servicio
                      </th>
                      <th>
                        Fecha
                      </th>
                      <th>
                        Costo
                      </th>
                      <th>
                        Costo de Visita
                      </th>                      
                      </tr>
                    </thead>
                   

                    <tbody>
                      <tr v-for="tab_detalles in prestadorDetalles" :key="tab_detalles.id">
                       
                        <td>
                          {{tab_detalles.categoriaDetalles}}
                        </td>

                        <td>
                          {{tab_detalles.servicioDetalles}}
                        </td>

                        <td>
                          {{tab_detalles.fechaDetalles}}
                        </td>

                        <td>      
                          ${{tab_detalles.costoDetalles}}  
                        </td>

                        <td>
                          ${{tab_detalles.costoVisitaDetalles}}                                       
                        </td>


                        

                      </tr>
                        
                      
                    </tbody>
                    
                  </table>
                <h5 style="text-align: right"><b>Monto Total:</b> ${{datosPrestador.montoModal}} </h5>
                <br>

            </div>
            

          </div>
        </div>
      </div>

      <br>
      <br>
      <br>
        <div>
                  <table id="example" class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                    <thead>
                      <tr>
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
                        Monto Total
                      </th>
                      <th>
                        Detalles
                      </th>                      
                      </tr>
                    </thead>
                   

                    <tbody>
                      <tr v-for="tab_prestadore in unionPrestadorTrabajos" :key="tab_prestadore.id">
                       
                        <td>
                          {{tab_prestadore.id}}
                        </td>

                        <td>
                          {{tab_prestadore.nombre}}
                        </td>

                        <td>      
                          {{tab_prestadore.apellidos}}  
                        </td>

                        <td>
                          ${{tab_prestadore.monto}}                                       
                        </td>


                        <td>
                           <button class="btn btn-warning"  @click="abrirModalDetalles(tab_prestadore)">Detalles</button>
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
  import datatable from 'datatables.net-bs4';
  
  
    export default {
      async mounted(){
        await this.getDatos();
        await this.crearTablaCompuesta();
        await this.tabla();
      },
      data(){
            return {  
                tab_prestadores: [],
                tab_trabajos: [],
                tab_categorias: [],
                tab_servicios: [],
                unionPrestadorTrabajos: [],
                id: '',
                nombre: '',
                apellidos: '',
                monto: '',      
                montoCambiante: 0,
                sumaMontosTotal: 0,
                datosPrestador: {idModal:'', nombreModal:'', apellidoModal:'', montoModal:''},
                prestadorDetalles: [],
                nombreDetalles: '',
                apellidoDetalles: '',
                categoriaDetalles: '',
                servicioDetalles: '',
                fechaDetalles: '',
                costoDetalles: '',
                costoVisitaDetalles: ''
            }
            
            
        },
        methods: {
        
        crearTablaCompuesta(){
            this.unionPrestadorTrabajos = [];
            for (let i = 0; i < this.tab_prestadores.length; i++) {
               

                for (let j = 0; j < this.tab_trabajos.length; j++) {
                    if(this.tab_trabajos[j].prestador_id == this.tab_prestadores[i].id){
                        let montoRecogido = this.tab_trabajos[j].costo;
                        let montoVisitaRecogido = this.tab_trabajos[j].costovisita;
                        let sumaMontos = montoRecogido + montoVisitaRecogido;
                        this.sumaMontosTotal = sumaMontos + this.sumaMontosTotal;
                    }
                }

                this.unionPrestadorTrabajos.push({id: this.tab_prestadores[i].id, nombre: this.tab_prestadores[i].nombre, apellidos: this.tab_prestadores[i].apellido, monto: this.sumaMontosTotal})
                this.sumaMontosTotal = 0;

              
            }
            
          
              
            
        },
        tabla(){
            this.$nextTick(() => {
            $('#example').DataTable();
            });
            
        },
        async getDatos(){
            await axios.get('tab_prestadores').then(res => this.tab_prestadores = res.data);
            await axios.get('tab_trabajos').then(res => this.tab_trabajos = res.data);
            await axios.get('tab_categorias').then(res => this.tab_categorias = res.data);
            await axios.get('tab_servicios').then(res => this.tab_servicios = res.data);            
        },         
        abrirModalDetalles(datos){
            this.datosPrestador= {idModal: datos.id , nombreModal: datos.nombre, apellidoModal: datos.apellidos, montoModal: datos.monto}   
            this.prestadorDetalles = [];
            for (let i = 0; i < this.tab_trabajos.length; i++) {
                if(this.tab_trabajos[i].prestador_id == datos.id){
                    var idServicioRecogido = this.tab_trabajos[i].servicio_id;
                    var idCategoriaRecogida = this.tab_servicios.find(x => x.id === idServicioRecogido).categoria_id;
                    var nombreServicioRecogido = this.tab_servicios.find(x => x.id === idServicioRecogido).nombre;
                    var nombreCategoriaRecogido = this.tab_categorias.find(x => x.id === idCategoriaRecogida).nombre;
                    var fechaRecogida = this.tab_trabajos[i].fecha_aceptacion;
                    var costoRecogido = this.tab_trabajos[i].costo;
                    var costoVisitaRecogido = this.tab_trabajos[i].costovisita;
                    this.prestadorDetalles.push({categoriaDetalles: nombreCategoriaRecogido, servicioDetalles: nombreServicioRecogido, fechaDetalles: fechaRecogida, costoDetalles: costoRecogido, costoVisitaDetalles: costoVisitaRecogido});


                }
                


            }
            this.$nextTick(() => {
            $('#example2').DataTable();
            });
            
            
            
            
            
            
            
            
            
            
            
            
            $('#modalForm').modal('show');


              
        }                
            
        }
        
    }

</script>










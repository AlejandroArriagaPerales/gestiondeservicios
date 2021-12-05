<template>
  <div>

    <div style="display: flex;">
      <div style="border-radius: 20px;" class="col-sm-2">
        <div style="color:#FFFFFF; " class="card card-chart">
          <div style="background-color: #011E3E; display: flex; " class="card-header">
            <h6 style="margin: auto;" class="card-title">Ganancias Totales</h6>
            <i class="fas fa-money-bill-wave-alt"></i>

          </div>
          <div style="background-color: #011E3E; " class="card-body">
            <h4><b>${{gananciaTotal}}</b></h4>
          </div>
          
        </div>
      </div>

      <div class="col-sm-2">
        <div style="color:#FFFFFF;" class="card card-chart">
          <div style="background-color: #F83A26; display: flex; " class="card-header">
            <h6 style="margin: auto;" class="card-title">Trabajos Terminados</h6>
            <i class="fas fa-check"></i>

          </div>
          <div style="background-color: #F83A26; " class="card-body">
            <h4><b>{{cantidadTrabajosFinalizados}}</b></h4>
          </div>
          
        </div>
      </div>

      <div class="col-sm-2">
        <div style="color:#FFFFFF;" class="card card-chart">
          <div style="background-color: #1681FC; display: flex; " class="card-header">
            <h6 style="margin: auto;" class="card-title">Trabajos Activos</h6>
            <i class="fas fa-clock"></i>

          </div>
          <div style="background-color: #1681FC; " class="card-body">
            <h4><b>{{cantidadTrabajosActivos}}</b></h4>
          </div>
          
        </div>
      </div>

      <div class="col-sm-2">
        <div style="color:#FFFFFF;" class="card card-chart">
          <div style="background-color: #E8891C; display: flex; " class="card-header">
            <div style="margin: auto; font-size: small " class="card-title">Cantidad Prestadores</div>
            <i class="fas fa-hard-hat"></i>

          </div>
          <div style="background-color: #E8891C; " class="card-body">
            <h4><b>{{cantidadPrestadores}}</b></h4>
          </div>
          
        </div>
      </div>

      <div class="col-sm-2">
        <div style="color:#FFFFFF;" class="card card-chart">
          <div style="background-color: #346A05; display: flex; " class="card-header">
            <h6 style="margin: auto;" class="card-title">Cantidad Clientes</h6>
            <i class="fas fa-user"></i>

          </div>
          <div style="background-color: #346A05; " class="card-body">
            <h4><b>{{cantidadClientes}}</b></h4>
          </div>
          
        </div>
      </div>


    </div>


  <br>

    <div style="display: flex;">
      
      <div class="col-lg-3">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Trabajos</h5>
            <h4 class="card-title">Historial de Trabajos</h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myChart" width="200px" height="200px"></canvas>
            </div>
          </div>
          
        </div>
      </div>
      

      <div class="col-lg-3">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Trabajos</h5>
            <h4 class="card-title">Ocupaciones en Trabajos</h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myChart2" width="200px" height="200px"></canvas>
            </div>
          </div>
          
        </div>
      </div>
  </div>
  <br>
  <div style="display: flex;">
      
      <div class="col-lg-12">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Trabajos</h5>
            <h4 class="card-title">Historial de Trabajos</h4>
          </div>
          <div class="card-body">
            <table class="table table-striped table-bordered table-condensed table-hover" style="width:100%">
                    <thead>
                      <tr>
                      <th>
                        ID
                      </th>
                      <th>
                        Estado del Trabajo
                      </th>
                      <th>
                        Costo
                      </th>
                      <th>
                        Costo de la Visita
                      </th>
                      <th>
                        Valoración
                      </th>                      
                      <th>
                        Nombre del Prestador
                      </th>
                      <th>
                        Nombre del Servicio
                      </th>
                                           
                      </tr>
                    </thead>
                   

                    <tbody>
                      <tr v-for="(tab_prestadore,index) in tab_trabajos" :key="tab_prestadore.id">
                       
                        <td>
                          {{tab_prestadore.id}}
                        </td>

                        <td>
                          {{tab_prestadore.estado_servicio}}
                        </td>

                        <td>      
                          ${{tab_prestadore.costo}}  
                        </td>

                        <td>      
                          ${{tab_prestadore.costovisita}}  
                        </td>

                        <td>
                          {{tab_prestadore.valoracion}} Estrellas                                        
                        </td>

                        <td>
                          {{tab_prestadores[tab_trabajos[index].prestador_id - 1 ].nombre}}                                       
                        </td>

                        <td>
                          {{tab_servicios[tab_trabajos[index].servicio_id - 1 ].nombre}}                                       
                        </td>

                        
                      </tr>
                        
                      
                    </tbody>
                    
                  </table>
                  

            
          </div>
          
        </div>
        <br>
      </div>
      
  </div>
  
  </div>
 
</template>

<script>

    import axios from "axios";
    export default {
      async mounted(){
        await this.getDatos();
        await this.prepararDatos();
        await this.getGraficas();
      },
        data(){
            return {
              tab_trabajos: [],
              tab_categorias: [],
              tab_servicios: [],
              tab_prestadores: [],
              tab_clientes: [],
              nombresCategorias: [],
              cantidadesCategorias: [],
              coloresCategorias: [],
              cantidadCategoriasSeparadas: [],
              nombre: '',
              cantidad: '',
              color: '',
              cantidadTrabajosActivos: 0,
              cantidadTrabajosFinalizados: 0,
              cantidadPrestadores: 0,
              cantidadClientes: 0,
              gananciaTotal: 0
            }
            
        },
        methods: {
            async getDatos(){
                await axios.get('tab_trabajos').then(response => this.tab_trabajos = response.data);
                await axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
                await axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
                await axios.get('tab_prestadores').then(response => this.tab_prestadores = response.data);
                await axios.get('tab_clientes').then(response => this.tab_clientes = response.data);
            },
            async prepararDatos(){
                //Cantidad Prestadores y Clientes
                for (let i = 0; i < this.tab_prestadores.length; i++) {
                    this.cantidadPrestadores++;
                }
                for (let i = 0; i < this.tab_clientes.length; i++) {
                    this.cantidadClientes++;
                }

                //Grafica de Activos y Finalizados
                for (let i = 0; i < this.tab_trabajos.length; i++) {
                    if(this.tab_trabajos[i].estado_servicio == 'activo'){
                        this.cantidadTrabajosActivos++;
                    }else{
                        this.cantidadTrabajosFinalizados++;
                    }

                    this.gananciaTotal= this.tab_trabajos[i].costo + this.tab_trabajos[i].costovisita + this.gananciaTotal;

                    
                }
                //Grafica de Trabajos tipo de Categoria
                for (let h = 0; h < this.tab_categorias.length; h++) {
                    this.nombresCategorias[h]=this.tab_categorias[h].nombre;  
                }

                for (let h = 0; h < this.tab_categorias.length; h++) {
                    function generarLetra(){
                        var letras = ["a","b","c","d","e","f","0","1","2","3","4","5","6","7","8","9"];
                        var numero = (Math.random()*15).toFixed(0);
                        return letras[numero];
                    }
                    function colorHEX(){
                        var coolor = "";
                        for(var i=0;i<6;i++){
                            coolor = coolor + generarLetra() ;
                        }
                        return "#" + coolor;
                    }
                    var colorAleatorio = colorHEX(); 
                    this.cantidadesCategorias.push({nombre: this.nombresCategorias[h], cantidad: 0, color: colorAleatorio})
                    this.coloresCategorias[h]= colorAleatorio;
                }

                for (let j = 0; j < this.tab_trabajos.length; j++) {
                    
                    var idServicioRecogido = this.tab_trabajos[j].servicio_id;
                    var idCategoriaRecogida = this.tab_servicios.find(x => x.id === idServicioRecogido).categoria_id;
                    var nombreServicioRecogido = this.tab_servicios.find(x => x.id === idServicioRecogido).nombre;
                    var nombreCategoriaRecogido = this.tab_categorias.find(x => x.id === idCategoriaRecogida).nombre;
                    for (let k = 0; k < this.cantidadesCategorias.length; k++) {
                       if(nombreCategoriaRecogido==this.cantidadesCategorias[k].nombre){
                           this.cantidadesCategorias[k].cantidad++;
                       }
                        
                    }
                    
                }


                for (let l = 0; l < this.tab_categorias.length; l++) {
                    this.cantidadCategoriasSeparadas[l]=this.cantidadesCategorias[l].cantidad;
                }
                


            },
            async getGraficas(){
            
            let ctx = document.getElementById('myChart').getContext('2d');
            let labels = ['Trabajos Activos', 'Trabajos Finalizados'];
            let colorHex = ['#FFC300','#C70039'];

            let ctx2 = document.getElementById('myChart2').getContext('2d');
            let labels2 = this.nombresCategorias;
            let colorHex2 = this.coloresCategorias;
            

            let myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    datasets: [{
                        data: [this.cantidadTrabajosActivos, this.cantidadTrabajosFinalizados],
                        backgroundColor: colorHex
                    }],
                    labels: labels
                },
                options: {
                    responsive: true
                }
                
            })

            let myChart2 = new Chart(ctx2, {
                
                type: 'pie',
                data: {
                    datasets: [{
                        data: this.cantidadCategoriasSeparadas,
                        backgroundColor: colorHex2
                    }],
                    labels: labels2
                },
                options: {
                    responsive: true
                }
                
            })

          }
          
        }
    }




</script>





<template>
  <div>
    <div style="display: flex;">
      
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Trabajos</h5>
            <h4 class="card-title">Historial de Trabajos</h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myChart" width="400" height="400"></canvas>
            </div>
          </div>
          
        </div>
      </div>
      

      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h5 class="card-category">Trabajos</h5>
            <h4 class="card-title">Ocupaciones en Trabajos</h4>
          </div>
          <div class="card-body">
            <div class="chart-area">
              <canvas id="myChart2" width="400" height="400"></canvas>
            </div>
          </div>
          
        </div>
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
              nombresCategorias: [],
              cantidadesCategorias: [],
              coloresCategorias: [],
              cantidadCategoriasSeparadas: [],
              nombre: '',
              cantidad: '',
              color: '',
              cantidadTrabajosActivos: 0,
              cantidadTrabajosFinalizados: 0
            }
            
        },
        methods: {
            async getDatos(){
                await axios.get('tab_trabajos').then(response => this.tab_trabajos = response.data);
                await axios.get('tab_categorias').then(response => this.tab_categorias = response.data);
                await axios.get('tab_servicios').then(response => this.tab_servicios = response.data);
            },
            async prepararDatos(){
                //Grafica de Activos y Finalizados
                for (let i = 0; i < this.tab_trabajos.length; i++) {
                    if(this.tab_trabajos[i].estado_servicio == 'activo'){
                        this.cantidadTrabajosActivos++;
                    }else{
                        this.cantidadTrabajosFinalizados++;
                    }
                    
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
                console.log(this.nombresCategorias);

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
                
                type: 'doughnut',
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

            console.log("Llegue");
          }
          
        }
    }




</script>





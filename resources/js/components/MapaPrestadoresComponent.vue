<template>

    <div>
        <div id="mapa"></div>
       
    </div>

            
</template>

<script>

    import axios from "axios";

  
    export default {
      async mounted(){
        await this.getData();
        await this.getMapa();
        
        
      },
        data(){
            return {
              tab_prestadores: []
            }
            
        },
        methods: {
          async getData(){
            await axios.get('tab_prestadores').then(res => this.tab_prestadores = res.data);
            console.log(this.tab_prestadores);
            
          },
          async getMapa(){
            
            
            //Lista la libreria
            
            var mapElement = document.getElementById('mapa');
            var map = new google.maps.Map(mapElement, {
                center: {
                lat: 23.714349,
                lng: -99.115030
                },
                zoom: 18
            });

            
            for (let i = 0; i < this.tab_prestadores.length; i++) {
              if(this.tab_prestadores[i].latitud!=null && this.tab_prestadores[i].longitud!=null){
                if(this.tab_prestadores[i].disponibilidad==1){
                  var latitudRecogida = this.tab_prestadores[i].latitud;
                  var longitudRecogida = this.tab_prestadores[i].longitud;
                  var coordenadas = {lat: latitudRecogida, lng: longitudRecogida};
                  var nombrePrestador = this.tab_prestadores[i].nombre;
                  var apellidoPrestador = this.tab_prestadores[i].apellido;

                  var marker = new google.maps.Marker({
                    position: coordenadas,
                    map,
                    title: nombrePrestador + " " + apellidoPrestador
                  });
                  
                  marker.setPosition(coordenadas);
                  }
                
              }
     
            }
              
            
            
          },
          
        }
    }
</script>

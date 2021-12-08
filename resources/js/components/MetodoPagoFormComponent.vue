<template>
    <div class="card-body">
                <form action="" v-on:submit.prevent="newMetodoPago()">
                        
                  <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreMetodoPago" required="required">
                  </div>
                  <br>

                  
                  
                  
       
                  <br>
                  <input style="width: 120px; height: 50px; background:#F96332; color:white" class="buttons" type="submit" name="" value="Agregar">
                  <br>
                </form>
              </div>
</template>

<script>


    export default {
        created(){
        axios.get('tab_metodopagos').then(response => this.tab_metodopagos = response.data);
      },
        data(){
            return {
                nombreMetodoPago: '',
                tab_metodopagos: [],
                encontrado: 0
            }
            
        },
        mounted(){

        },
        methods: {
            newMetodoPago(){
                for (let i = 0; i < this.tab_metodopagos.length; i++) {
                  if(this.tab_metodopagos[i].nombre == this.nombreMetodoPago){
                    this.encontrado=1;
                  } 
              }
              if (this.encontrado==1) {
                  Vue.swal("Método de pago ya existente", "", "error");
                  this.encontrado=0;
                  
              }else{
                const params = {
                    nombreMetodoPago: this.nombreMetodoPago
                    
                };
                this.nombreMetodoPago='';
                
                
                
                axios.post('tab_metodopagos',params).then((response) => {
                  const nombreMetodoPago = response.data;
                  this.$emit('new',nombreMetodoPago);
                  Vue.swal("Guardando método de pago, porfavor espere...", "", "success");   
                  setTimeout(function(){
                    location.reload();
                  },1500);
                });
              }
                
             
                
            }
        }
    }
</script>





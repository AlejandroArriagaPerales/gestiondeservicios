<template>
    <div class="card-body">
                <form action="" v-on:submit.prevent="newMetodoPago()">
                        
                  <div class="form-group">
                    <label>Nombre(s)</label>
                    <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreMetodoPago">
                  </div>
                  <br>

                  
                  
                  
       
                  <br>
                  <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">
                  <br>
                </form>
              </div>
</template>

<script>


    export default {
        data(){
            return {
                nombreMetodoPago: ''
            }
            
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newMetodoPago(){
                const params = {
                    nombreMetodoPago: this.nombreMetodoPago
                    
                };
                this.nombreMetodoPago='';
                confirm('Metodo de Pago Agregado', 'Confirmación');
                
                
                
                axios.post('tab_metodopagos',params).then((response) => {
                  const nombreMetodoPago = response.data;
                  this.$emit('new',nombreMetodoPago);
                });
                
             
                
            }
        }
    }
</script>





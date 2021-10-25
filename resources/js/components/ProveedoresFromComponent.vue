<template>
    <div class="card-body">
              <form action="" v-on:submit.prevent="newProveedor()">
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Nombre de la Empresa</label>
                      <input type="text" class="form-control" placeholder="Nombre(s)" v-model="nombreProveedor">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Dirección</label>
                      <input type="text" class="form-control" placeholder="Dirección" v-model="direccionProveedor">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Registro Federal de Contribuyentes (RFC)</label>
                      <input type="text" class="form-control" placeholder="RFC" v-model="rfcProveedor">
                    </div>
                  </div>
                </div>
              
                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Teléfono</label>
                      <input type="tel" class="form-control" placeholder="Teléfono" v-model="telefonoProveedor">
                    </div>
                  </div>
                </div>

                <div class="">
                  <div class="">
                    <div class="form-group">
                      <label>Correo Electrónico</label>
                      <input type="email" class="form-control" placeholder="Correo Electrónico" v-model="correoProveedor">
                    </div>
                  </div>
                </div>

                <div class="seleccionar">
                    <label for="img" class="negrita">Selecciona un icono:</label>   
                    <br>          

                      <div>
                        <input name="img[]" type="file" id="img" multiple="multiple" >
                        <br>
                        <br>
                        <!--
                        @if ( !empty ( $bicicletas->imagenes) )
                          <span>Imagen(es) Actual(es): </span>
                          <br>

                          @if(Session::has('message'))
                            <div class="alert alert-primary" role="alert">
                              {{ Session::get('message') }}
                            </div>
                          @endif

                          @foreach($imagenes as $img)                    
                            <img src="../../../uploads/{{ $img->nombre }}" width="200" class="img-fluid"> 
                            <a href="{{ route('admin/bicicletas/eliminarimagen', [$img->id, $bicicletas->id]) }}" class="btn btn-danger btn-sm" onclick="return confirmarEliminar();">Eliminar</a> 
                          @endforeach

                        @else
                        @endif 
                        -->

                      </div>
            
                  </div>

                <br>
                <input style="width: 120px; height: 50px;" class="buttons" type="submit" name="" value="Agregar">
                        
              </form>
            </div>
</template>

<script>
    export default {
      
        data(){
            return {
                nombreProveedor: '',
                apellidoProveedor: '',
                direccionProveedor: '',
                rfcProveedor: '',
                telefonoProveedor: '',
                correoProveedor: ''
            }
            
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            newProveedor(){
                const params = {
                    nombreProveedor: this.nombreProveedor,
                    apellidoProveedor: this.apellidoProveedor,
                    direccionProveedor: this.direccionProveedor,
                    rfcProveedor: this.rfcProveedor,
                    telefonoProveedor: this.telefonoProveedor,
                    correoProveedor: this.correoProveedor
                };
                this.nombreProveedor='';
                this.apellidoProveedor='';
                this.direccionProveedor='';
                this.rfcProveedor='';
                this.telefonoProveedor='';
                this.correoProveedor='';
               
                axios.post('tab_proveedores',params).then((response) => {
                  const nombreProveedor = response.data;
                  const apellidoProveedor = response.data;
                  const direccionProveedor = response.data;
                  const rfcProveedor = response.data;
                  const telefonoProveedor = response.data;
                  const correoProveedor = response.data;
                  this.$emit('new',nombreProveedor);
                  this.$emit('new',apellidoProveedor);
                  this.$emit('new',direccionProveedor);
                  this.$emit('new',rfcProveedor);
                  this.$emit('new',telefonoProveedor);
                  this.$emit('new',correoProveedor);
                  Vue.swal("Proveedor Agregado", "", "success");
                });
             
                
            }
        }
    }
</script>


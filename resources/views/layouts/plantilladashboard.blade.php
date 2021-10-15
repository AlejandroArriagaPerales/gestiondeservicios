<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>@yield('title')</title>
  
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />
  <link href="css/now-ui-dashboard.css?v=1.5.0" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/estilo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    
    
  <div class="side-bar" >
      
    <div class="menu">
        <div class="item"><a href="dashboard"><i class="fa-solid fa-grip"></i>Dashboard</a></div>
        
        <div class="item">
          <a class="sub-btn"><i class="fas fa-desktop"></i>Administrador<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="registroadministradores" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Administrador</a>
          </div>
        </div>

        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-helmet-safety"></i>Prestador Servicio<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="registroprestadores" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Prestadores</a>
            <a href="tablaprestadores" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Prestadores</a>
          </div>
        </div>

        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-user"></i>Cliente<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="registroclientes" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Clientes</a>
            <a href="tablaclientes" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Clientes</a>
          </div>
        </div>

        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-brush"></i>Servicios<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="registrocategorias" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Categorias</a>
            <a href="registroservicios" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Servicios</a>
            <a href="tablacategorias" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Categorias</a>
            <a href="tablaservicios" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Servicios</a>
          </div>
        </div>

        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-store"></i>Proveedores<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="registroproveedores" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Proveedores</a>
            <a href="registrocontactoproveedores" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Contacto</a>
            <a href="tablaproveedores" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Proveedores</a>
            <a href="tablacontactosproveedores" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Contactos</a>
          </div>
        </div>

        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-bag-shopping"></i>Productos<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="registroproductos" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Productos</a>
            <a href="registrocategoriaproductos" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Categorias Productos</a>
            <a href="tablaproductos" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Productos</a>
            <a href="tablacategoriaproductos" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Categorias Productos</a>
          </div>
        </div>

        <div class="item">
          <a class="sub-btn"><i class="fa-solid fa-money-check-dollar"></i>Metodos de Pago<i class="fas fa-angle-right dropdown"></i></a>
          <div class="sub-menu">
            <a href="registrometodopago" class="sub-item"><i class="fa-solid fa-pencil"></i>Registro Metodo de Pago</a>
            <a href="tablametodospago" class="sub-item"><i class="fa-solid fa-table"></i>Tabla Metodo de Pago</a>
          </div>
        </div>

        



    </div>
    
  </div>

    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
          
        <div class="container-fluid">
          <div class="navbar-wrapper">
            
            <a class="navbar-brand">@yield('tituloPagina')</a>
            
            
          </div>
          
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            
            <div style="padding-right: 30px;">        
              <button class="botonsalir"  href="{{ route('logout') }}">
                  <i class="fa-solid fa-right-from-bracket"></i> Salir                 
              </button>
            </div>  

          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      
       </div>
      
        <!-- Contenido Diferente -->
       
        @yield('content')
     
      
      
      <footer class="footer">
      </footer>
      
    </div>
    
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      //jquery for toggle sub menus
      $('.sub-btn').click(function(){
        $(this).next('.sub-menu').slideToggle();
        $(this).find('.dropdown').toggleClass('rotate');
      });
 
      //jquery for expand and collapse the sidebar
      $('.menu-btn').click(function(){
        $('.side-bar').addClass('active');
        $('.menu-btn').css("visibility", "hidden");
      });
 
      $('.close-btn').click(function(){
        $('.side-bar').removeClass('active');
        $('.menu-btn').css("visibility", "visible");
      });
    });
    </script>
  
</body>

</html>
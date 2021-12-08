<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>
  <!-- Custom fonts for this template -->
 

  <link
      href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
      rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/bootstrap.min.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link rel="stylesheet" href="css/estilo.css">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="https://unpkg.com/vue-select@3.0.0"></script>
  <script src="https://unpkg.com/vue@latest"></script>
  <link rel="stylesheet" href="https://unpkg.com/vue-select@3.0.0/dist/vue-select.css">
  <script src="https://unpkg.com/vue-select@latest"></script>
  <link rel="stylesheet" href="https://unpkg.com/vue-select@latest/dist/vue-select.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js" defer></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js" defer></script>
  
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.0/chart.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script> 
  <script src="{{ asset('js/app.js') }}" defer></script>
 
</head>









<body>
  
  <div class="sidebar open" >
    <div class="logo-details">
      <i class="fas fa-hammer"></i>
      <span class="logo_name">Servicios Victoria</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="dashboard">
          <i class="fa-solid fa-grip"></i>
          <span class="link_name">Dashboard</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="dashboard">Dashboard</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fas fa-desktop"></i>
            <span class="link_name">Administrador</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Administrador</a></li>
          <li><a href="registroadministradores">Registro Administrador</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-helmet-safety"></i>
            <span class="link_name">Prestador Servicio</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Prestador Servicio</a></li>
          <li><a href="registroprestadores">Registro Prestador</a></li>
          <li><a href="tablaprestadores">Tabla Prestador</a></li>
         
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-user"></i>
            <span class="link_name">Clientes</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Clientes</a></li>
          <li><a href="registroclientes">Registro Clientes</a></li>
          <li><a href="tablaclientes">Tabla Clientes</a></li>
         
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-brush"></i>
            <span class="link_name">Servicios</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Servicios</a></li>
          <li><a href="registrocategorias">Registro Categoria</a></li>
          <li><a href="registroservicios">Registro Servicios</a></li>
          <li><a href="tablacategorias">Tabla Categorias</a></li>
          <li><a href="tablaservicios">Tabla Servicios</a></li>
         
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-store"></i>
            <span class="link_name">Proveedores</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Proveedores</a></li>
          <li><a href="registroproveedores">Registro Proveedores</a></li>
          <li><a href="registrocontactoproveedores">Registro Contactos</a></li>
          <li><a href="tablaproveedores">Tabla Proveedores</a></li>
          <li><a href="tablacontactosproveedores">Tabla Contactos</a></li>
         
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-bag-shopping"></i>
            <span class="link_name">Productos</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Productos</a></li>
          <li><a href="registroproductos">Registro Productos</a></li>
          <li><a href="registrocategoriaproductos">Registro Categorias Productos</a></li>
          <li><a href="tablaproductos">Tabla Productos</a></li>
          <li><a href="tablacategoriaproductos">Tabla Categorias Productos</a></li>
         
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-money-check-dollar"></i>
            <span class="link_name">Metodos de Pago</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Metodos de Pago</a></li>
          <li><a href="registrometodopago">Registro Metodos de Pago</a></li>
          <li><a href="tablametodospago">Tabla Metodos de Pago</a></li>
         
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fas fa-chart-pie"></i>
            <span class="link_name">Finanzas</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Finanzas</a></li>
          <li><a href="finanzas">Finanzas de Prestadores</a></li>
         
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fas fa-map-marker-alt"></i>
            <span class="link_name">Mapa</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Mapa</a></li>
          <li><a href="mapaprestadores">Mapa de Prestadores</a></li>
         
        </ul>
      </li>

    <li>
        <div class="profile-details">
        <div class="profile-content">
          
        </div>
        <a href="{{ route('logout') }}">
        <div class="name-job">
          <div class="profile_name">Cerrar Sesión</div>
          
        
        </div>
        <i class='bx bx-log-out' ></i>
        </a>
        </div>
    </li>

</ul>
  </div>


  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu' ></i>
      <span class="text">@yield('title')</span>
    </div>

    <div id="app">
      @yield('content')
    </div>

    

    



  </section>

  
  


  
  <script>
  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });

</script>






</body>

</html>
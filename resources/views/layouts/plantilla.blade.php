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
  <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body>
    
    
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <div class="logo">
        <a class="simple-text logo-normal">
          @yield('tituloBarra')
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <!-- <li class="active "> -->
            <a href="dashboard">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="registroprestadores">
              <i class="now-ui-icons education_atom"></i>
              <p>Registro Prestadores</p>
            </a>
          </li>
          <li>
            <a href="registroadministradores">
              <i class="now-ui-icons education_atom"></i>
              <p>Registro Administradores</p>
            </a>
          </li>
          <li>
            <a href="registroclientes">
              <i class="now-ui-icons design_app"></i>
              <p>Registro de Clientes</p>
            </a>
          </li>
          <li>
            <a href="registrocategorias">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Registro de Categorias</p>
            </a>
          </li>
          <li>
          <li>
              <a href="registroservicios">
                <i class="now-ui-icons education_atom"></i>
                <p>Registro de Servicios</p>
              </a>
            </li>
          <li>
            
            <a href="tablaprestadores">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Tabla de Prestadores</p>
            </a>
          </li>
          <li>
            <a href="tabladministradores">
              <i class="now-ui-icons users_single-02"></i>
              <p>Tabla de Administradores</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>

    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
          
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">@yield('tituloPagina')</a>
            
            
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Buscar...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="now-ui-icons ui-1_zoom-bold"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Account</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="panel-header panel-header-sm">
      
       </div>
      
        <!-- Contenido Diferente -->
        <div id="app">
        @yield('content')
        </div>
      
      
      <footer class="footer">
      </footer>
      
    </div>
    
  </div>
  
</body>

</html>
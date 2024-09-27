<!DOCTYPE html>
    <html>
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Archivo</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
@yield('links')
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
      <!-- Google Font: Source Sans Pro -->
      <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    </head>
    <body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-blue navbar-dark" style="background-color: #dee2e6;">
        <!-- Contenido de la barra de navegación -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: #23831E;"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
        
        <!-- Imagen
        <img src="../../dist/img/franja_web_Mesa1.png" alt="Imagen Horizontal" style="display: block; width: 100%; margin-top: -1px;"> -->

        <!-- Contenido de la barra de navegación (continuación) -->
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <img src="../../dist/img/cggp.jpg" class="user-image img-circle elevation-2" alt="User Image">
              <span class="d-none d-md-inline" style="color: #23831E;">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-dark">
                <img src="../../dist/img/cggp.jpg" class="img-circle elevation-2" alt="User Image">
                <p> {{ auth()->user()->name }}
                  <small>{{ auth()->user()->email }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer" style="text-align: right;">
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                  <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                      {{ __('Logout') }}
                  </x-jet-dropdown-link>
                </form>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #dee2e6;">
        <!-- Brand Logo -->
        <!-- <a href="#" class="brand-link"> -->
          <img src="../../dist/img/Logo_alcaldia_negro.png"
               alt="Alcaldía de Cúcuta Logo"
               class="brand-image elevation-2"
               width="250" height="90"
               >
               <br/>
               <br/>
          <!-- <span class="brand-text font-weight-light">CÚCUTA 2050<br/><small>Alcaldía de San José de Cúcuta</small></span> -->
        <!-- </a> -->

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                   <?php if(auth()->user()->rol_id == 1): ?>
                    <!-- <li class="nav-item nav-item-hover">
                        <a href="{{ url('/dependencia/') }}" class="nav-link">
                          <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em"  style="color: #495057;" class="bi bi-border-width nav-item-hover" viewBox="0 0 16 16">
                            <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                          </svg>
                          <p style="color: #495057;">
                            DEPENDENCIAS
                          </p>
                        </a>
                    </li> -->

                    <li class="nav-item nav-item-hover">
                      <a href="{{ url('/dependencia/') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" style="color: #495057;" class="bi bi-border-width" viewBox="0 0 16 16">
                          <path d="M0 3.5A.5.5 0 0 1 .5 3h15a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-2zm0 5A.5.5 0 0 1 .5 8h15a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H.5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h15a.5.5 0 0 1 0 1H.5a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <p style="color: #495057;">
                          DEPENDENCIAS
                        </p>
                      </a>
                    </li>


                    <li class="nav-item nav-item-hover ">
                        <a href="{{ url('/admin/') }}" class="nav-link">
                          <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" style="color: #495057;" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.245z"/>
                          </svg>
                          <p style="color: #495057;">
                            USUARIOS
                          </p>
                        </a>
                    </li>
                  <?php endif; ?>

                    <?php if (auth()->user()->rol_id == 2): ?>
                      <?php $url = (auth()->user()->id_subdependencia == null) ? url('/subdependencia/'.auth()->user()->id_dependencia.'/index') : url('/subdepe/'.auth()->user()->id_subdependencia.'/index'); ?>
                      <li class="nav-item nav-item-hover">
                          <a href="<?php echo $url; ?>" class="nav-link" style="color: #495057;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                              <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5Z"/>
                            </svg>
                            <p style="color: #495057;">
                                Inicio
                            </p>
                          </a>
                      </li>

                      <li class="nav-item nav-item-hover">
                        <a href="{{url('/change-password/')}}" class="nav-link" style="color: #495057;" >
                          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                          </svg>
                          <p style="color: #495057;">
                            CAMBIAR CONTRASEÑA
                          </p>
                        </a>
                      </li>
                  <?php endif; ?>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

@yield('app')
        <style>
          .nav-item-hover:hover a {
            fill: #23831E; /* Cambia "your-color" al color deseado para el icono */
          }
          .nav-item1-hover:hover p {
            color: #23831E; /* Cambia "your-color" al color deseado para el icono */
          }
        </style>

        <!-- <footer class="main-footer">
          <div class="container">
            <div class="row">
               <div class="col-sm">
                  <p class="m-0 text-center text-success"><strong>Copyright &copy;  Desarrollado por Ing. Cistian G. Gutiérrez p.</strong></p>
               </div> 
            </div>
          </div>
        </footer> -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
@yield('javascript')
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </body>
    </html>

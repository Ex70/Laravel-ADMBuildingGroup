<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Grupo Constructor ADM</title>
        <link rel="stylesheet" href="css/app.css">
        <style>
            .sidebar .nav-link p, .main-sidebar .brand-text, .main-sidebar .logo-xs, .main-sidebar .logo-xl, .sidebar .user-panel .info {
                transition: margin-left 0.3s linear, opacity 0.3s ease, visibility 0.3s ease;
                font-size: 0.8em;
            }
            .nav-sidebar .menu-open > .nav-treeview {
                display: block;
                margin-left: 10px;
            }
        </style>
    </head>
    <body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
        <div class="wrapper" id="app">
        <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>
                <!-- SEARCH FORM -->
                <form class="form-inline ml-3">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar" type="search" placeholder="Buscar" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="../img/img-user2.png" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline">{{Auth::user()->usuario}}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-gray">
                                <img src="../img/img-user2.png" class="img-circle elevation-2" alt="User Image">
                                <p>
                                {{Auth::user()->nombre}}
                                <small>{{Auth::user()->usuario}}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="/usuario" class="btn btn-outline-secondary">Perfil</a>
                                <a href="{{ route('logout') }}" class="btn btn-outline-secondary float-right" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Cerrar sesión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="index3.html" class="brand-link">
                    <img src="../img/logo.png" alt="ADM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Grupo ADM</span>
                </a>
                <div class="sidebar">
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <router-link class="nav-link" :to="{ name: 'idEmpresa', params: {empresa: {{Session::get('empresa')}}}}">
                                    <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                    <p>Escritorio</p>
                                </router-link>
                                <!-- <router-link to="/dashboard" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                    <p>Escritorio</p>
                                </router-link> -->
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-money-bill-alt green"></i>
                                    <p>PRESUPUESTO BASE
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/pptobase/importar" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                            <p>Importar</p>
                                        </router-link>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/pptobase/consultar" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                            <p>Consultar</p>
                                        </router-link>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/pptobase/reportes" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                            <p>Reportes</p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-user indigo"></i>
                                    <p>
                                    PRESUPUESTO CLIENTE
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Importación
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/pptocliente/autorizar" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                                    <p>Autorizar</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/pptocliente/actualizar" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                                    <p>Actualizar</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Modificar
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/pptocliente/aditivas" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                                    <p>Aditivas</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/pptocliente/deductivas" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                                    <p>Deductivas</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/pptocliente/estimacion" class="nav-link">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Estimación</p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-calculator orange"></i>
                                    <p>
                                    PRESUPUESTO CONTROL
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/pptocontrol/importar" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                                            <p>Importar</p>
                                        </router-link>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Modificar
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/pptocontrol/aditivas" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Aditivas</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/pptocontrol/deductivas" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Deductivas</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Explosión de insumos
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/pptocontrol/generar" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Generar</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/pptocontrol/consultar" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Consultar</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart yellow"></i>
                                    <p>
                                    COMPRAS
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Orden de compra
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/compras/captura" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Captura</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/compras/autorizacion" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Autorización</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-boxes teal"></i>
                                    <p>
                                    INVENTARIOS
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/inventarios/por-obra" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                                            <p>Por obra</p>
                                        </router-link>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Entradas
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/inventarios/compras" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Compras</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/inventarios/recuperacion" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Recuperación</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/inventarios/traspaso" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Traspaso</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Salidas
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/inventarios/para-obra" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Para Obra</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/inventarios/merma" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Merma</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/inventarios/traspasos" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Traspaso</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-money-bill-alt green"></i>
                                    <p>GASTOS
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/gastos/generales" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                                            <p>Generales</p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-file-alt"></i>
                                    <p>
                                    REPORTES
                                    <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Financieros
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                                <router-link to="/reportes/por-obra" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Por Obra</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/reportes/por-cliente" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Por Cliente</p>
                                                </router-link>
                                            </li>
                                            <li class="nav-item">
                                                <router-link to="/reportes/generales" class="nav-link">
                                                    <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                    <p>Generales</p>
                                                </router-link>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @can('isAdmin')
                            <li class="nav-header">Administración</li>
                            <li class="nav-item has-treeview">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-cog"></i>
                                        <p>CONTROL DE SISTEMA
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <router-link to="/accesos" :user="{{ Auth::user() }}" class="nav-link">
                                        <i class="nav-icon fas fa-key"></i>
                                        <p>Accesos</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/ciudades" class="nav-link">
                                        <i class="nav-icon fas fa-building"></i>
                                        <p>Ciudades</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/empresas" class="nav-link">
                                        <i class="nav-icon fas fa-industry"></i>
                                        <p>Empresas</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/estados" class="nav-link">
                                        <i class="nav-icon fas fa-city"></i>
                                        <p>Estados</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/modulos" class="nav-link">
                                        <i class="nav-icon fas fa-user"></i>
                                        <p>Modulos</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/unidades" class="nav-link">
                                        <i class="nav-icon fas fa-weight-hanging"></i>
                                        <p>Unidades</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/users" :user="{{ Auth::user() }}" class="nav-link">
                                        <i class="fas fa-users nav-icon"></i>
                                        <p>Usuarios</p>
                                    </router-link>
                                </li>
                            </ul>
                        </li>
                            @endcan
                            <li class="nav-item">
                                <!-- <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas fa-power-off red"></i>
                                    <p>{{ __('Cerrar sesión') }}</p>
                                </a> -->
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <div class="content-wrapper">
                    <div class="content">
                        <div class="container-fluid">
                            <router-view :user="{{ Auth::user() }}"></router-view>
                            <vue-progress-bar></vue-progress-bar>
                        </div>
                    </div>
                </div>
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                    <div class="p-3">
                    <h5>Title</h5>
                    <p>Sidebar content</p>
                    </div>
                </aside>
                <!-- /.control-sidebar -->
                <!-- Main Footer -->
                <footer class="main-footer">
                    <!-- To the right -->
                    <div class="float-right d-none d-sm-inline"><strong><a href="#">Grupo Constructor ADM</a>.</strong></div>
                    <!-- Default to the left -->
                    <strong>Copyright &copy; 2021. Empresa: {{Session::get('empresa')}}</strong>
                </footer>
            </div>
            <!-- ./wrapper -->
            @auth
            <script>
                window.user = @json(auth()->user())
            </script>
            @endauth
        <script src="js/app.js"></script>
    </body>
</html>

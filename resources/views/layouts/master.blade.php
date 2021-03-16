<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Grupo Constructor ADM</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper" id="app">
        <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <!-- <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li> -->
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
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="../img/logo.png" alt="ADM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Grupo ADM</span>
                </a>
                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="../img/img-user2.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block" style="text-transform: capitalize;">{{Auth::user()->nombre}}</a>
                        </div>
                    </div>
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <router-link to="/dashboard" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt blue"></i>
                                    <p>Escritorio</p>
                                </router-link>
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
                                        <router-link to="/users" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                            <p>Importar</p>
                                        </router-link>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/users" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                            <p>Consultar</p>
                                        </router-link>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/users" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                            <p>Reportes</p>
                                        </router-link>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/users" class="nav-link">
                                            <i class="fas fa-chevron-circle-right nav-icon white"></i>
                                            <p>Reportes</p>
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
                                        <router-link to="/users" class="nav-link">
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Aditivas</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Deductivas</p>
                                            </a>
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Generar</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Consultar</p>
                                            </a>
                                            </li>
                                        </ul>
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Autorizar</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Actualizar</p>
                                            </a>
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-dot-circle nav-icon"></i>
                                                <p>Aditivas</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-dot-circle nav-icon"></i>
                                                <p>Deductivas</p>
                                            </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/users" class="nav-link">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Estimación</p>
                                        </router-link>
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Captura</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Autorización</p>
                                            </a>
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
                                <ul class="nav nav-treeview" style="display: none;">
                                    <li class="nav-item has-treeview">
                                        <a href="#" class="nav-link">
                                            <i class="fas fa-circle nav-icon"></i>
                                            <p>
                                            Por obra
                                            <i class="right fas fa-angle-left"></i>
                                            </p>
                                        </a>
                                        <ul class="nav nav-treeview">
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Captura</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Autorización</p>
                                            </a>
                                            </li>
                                        </ul>
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Compras</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Recuperación</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Traspaso</p>
                                            </a>
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Para Obra</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Merma</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Traspaso</p>
                                            </a>
                                            </li>
                                        </ul>
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
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Por Obra</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Por Cliente</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                                <p>Generales</p>
                                            </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-header">CONTROL DE SISTEMA</li>
                            <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-cog green"></i>
                                    <p>Management
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <router-link to="/users" class="nav-link">
                                            <i class="fas fa-users nav-icon"></i>
                                            <p>Users</p>
                                        </router-link>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <router-link to="/developer" class="nav-link">
                                    <i class="nav-icon fas fa-user orange"></i>
                                    <p>Developer</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/profile" class="nav-link">
                                    <i class="nav-icon fas fa-user orange"></i>
                                    <p>Profile</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/estados" class="nav-link">
                                    <i class="nav-icon fas fa-user orange"></i>
                                    <p>Estados</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/modulos" class="nav-link">
                                    <i class="nav-icon fas fa-user orange"></i>
                                    <p>Modulos</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="nav-icon fas fa-power-off red"></i>
                                    <p>{{ __('Logout') }}</p>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                            </ul>
                        </nav>
                        <!-- /.sidebar-menu -->
                    </div>
                <!-- /.sidebar -->
                </aside>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Main content -->
                    <div class="content">
                        <div class="container-fluid">
                            <router-view></router-view>
                            <vue-progress-bar></vue-progress-bar>
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
                <!-- Control Sidebar -->
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
                    <strong>Copyright &copy; 2021.</strong>
                </footer>
            </div>
            <!-- ./wrapper -->
        <script src="/js/app.js"></script>
    </body>
</html>

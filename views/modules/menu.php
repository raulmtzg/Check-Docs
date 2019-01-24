<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- <li class="header">OPCIONES DE MENU</li> -->
      <li>
        <a href="inicio">
          <i class="fa fa-home"></i> <span>Inicio</span>
        </a>
      </li>

      <!-- Aquí van todas las opciones de procesos creador dinamicamente -->
      <li class="header">PROCESOS</li>
      <?php
        $procesos = new MenuProcesos();
        $procesos ->listarOpcionesMenuController();

      ?>



      <!-- Esta seccion solo será para el administrador del sistema -->
        <li class="header">CONFIGURACIONES</li>
      <?php

      if($_SESSION['perfil']=="1") {

          $administracion="";
          $administracion.='<li class="treeview">
            <a href="#">
              <i class="fa fa-bug"></i>
              <span>ADMINISTRACIÓN</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="#"><i class="fa fa-circle-o"></i> Tablero</a></li>
              <li><a href="admin_inicio"><i class="fa fa-circle-o"></i> Página inicio</a></li>
              <li><a href="#"><i class="fa fa-circle-o"></i> Usuarios</a></li>
              <li><a href="procesos"><i class="fa fa-circle-o"></i> Procesos</a></li>
            </ul>
          </li>';
          echo $administracion;
        }
      ?>


      <li>
        <a href="salir">
          <i class="fa fa-sign-out"></i> <span>CERRAR SESIÓN</span>
        </a>
      </li>

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>

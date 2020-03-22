<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">PROCESOS</li>
                <?php
                  $procesos = new MenuProcesos();
                  $procesos ->listarOpcionesMenuController();

                ?>
                <!-- <li>
                  <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                    <i class="mdi mdi-gauge"></i>
                    <span class="hide-menu">Dashboard</span>
                  </a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="index.html">Minimal </a></li>
                        <li><a href="index2.html">Analytical</a></li>
                        <li><a href="index3.html">Demographical</a></li>
                        <li><a href="index4.html">Modern</a></li>
                    </ul>
                </li> -->
                <!-- <li class="nav-devider"></li>-->

                <?php

                if($_SESSION['perfil']=="1") {

                    $administracion="";
                    $administracion.='<li class="nav-small-cap">CONFIGURACIONES</li>';
                    $administracion.='
                      <li>
                        <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false">
                          <i class="mdi mdi-arrange-send-backward"></i><span class="hide-menu">ADMINISTRACIÓN</span>
                        </a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="admin_inicio"><i class="fa fa-circle-o"></i> Página inicio</a></li>
                            <li><a href="tipo_documento"><i class="fa fa-circle-o"></i> Tipo Documento</a></li>
                            <li><a href="usuarios"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                            <li><a href="procesos"><i class="fa fa-circle-o"></i> Procesos</a></li>
                        </ul>
                    </li>';

                    echo $administracion;
                  }
                ?>



                <!-- <li class="nav-small-cap">EXTRA COMPONENTS</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-arrange-send-backward"></i><span class="hide-menu">Multi level dd</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="#">item 1.1</a></li>
                        <li><a href="#">item 1.2</a></li>
                        <li> <a class="has-arrow" href="#" aria-expanded="false">Menu 1.3</a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="#">item 1.3.1</a></li>
                                <li><a href="#">item 1.3.2</a></li>
                                <li><a href="#">item 1.3.3</a></li>
                                <li><a href="#">item 1.3.4</a></li>
                            </ul>
                        </li>
                        <li><a href="#">item 1.4</a></li>
                    </ul>
                </li> -->
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

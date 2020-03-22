<?php
   session_start();
  if(!$_SESSION['validar']){
    header("location:ingreso");
    exit();
  }else{
    include "header.php";
    include "menu.php";
  }
 ?>
 <!-- ============================================================== -->
 <!-- Page wrapper  -->
 <!-- ============================================================== -->
 <div class="page-wrapper">

     <!-- ============================================================== -->
     <!-- Container fluid  -->
     <!-- ============================================================== -->
     <div class="container-fluid">
         <!-- ============================================================== -->
         <!-- Bread crumb and right sidebar toggle -->
         <!-- ============================================================== -->
         <div class="row page-titles">
             <div class="col-md-5 align-self-center">
                 <h3 class="text-themecolor">
                   Edición de Tipos Documentos
                   <button id="btnNuevoDocto" onclick="mostrarform(true)" class="btn btn-success waves-effect waves-light" type="button"><span class="btn-label"><i class="fa fa-plus-circle"></i></span>Nuevo</button>
                   <!-- <button type="button" id="btnNuevoDocto" onclick="mostrarform(true)" class="btn btn-success"><i class="fa fa-plus-circle"></i> Nuevo</button> -->
                 </h3>
             </div>
             <div class="col-md-7 align-self-center">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item">
                         <a href="javascript:void(0)">Home</a>
                     </li>
                     <li class="breadcrumb-item">pages</li>
                     <li class="breadcrumb-item active">Blank Page</li>
                 </ol>
             </div>
         </div>
         <!-- ============================================================== -->
         <!-- End Bread crumb and right sidebar toggle -->
         <!-- ============================================================== -->

         <!-- ============================================================== -->
         <!-- Start Page Content -->
         <!-- ============================================================== -->
         <div class="row">
           <div class="col-lg-12 col-sm-12 col-sm-12 col-xs-12">
             <div class="card">
               <div id="formularioregistros" class="card-body ocultar-contenido">
                 <h4 class="card-title"><span class="lstick"></span>Nuevo registro</h4>
                 <form name="formulario" id="formulario" method="POST">
                   <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                     <label>Descripción:</label>
                     <input type="hidden" name="idtipodocumento" id="idtipodocumento">
                     <input type="text" class="form-control" name="descripcion" id="descripcion" placeholder="" required autocomplete="off" autofocus>
                   </div>

                   <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6 btnfrmline">
                     <button class="btn btn-primary " type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                     <button class="btn btn-danger " onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                   </div>
                   <div class="row">
                     <br>
                     <div class="col-lg-12">
                       <div id="fail-label" class="alert alert-warning ocultar-contenido"></div>
                       <div id="exito-label" class="alert alert-success ocultar-contenido"></div>
                     </div>
                   </div>
                 </form>
               </div>

               <div id="listadoregistros" class="card-body ">
                 <h4 class="card-title"><span class="lstick"></span>Listado</h4>
                 <div class="table-responsive">
                   <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                     <thead>
                       <th>NOMBRE COMPLETO</th>
                       <th>NOMBRE USUARIO</th>
                       <th>PERFIL</th>
                       <th>EMAIL</th>
                       <th class="text-center">ESTADO</th>
                       <th class="text-center">OPCIONES</th>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                       <th>NOMBRE COMPLETO</th>
                       <th>NOMBRE USUARIO</th>
                       <th>PERFIL</th>
                       <th>EMAIL</th>
                       <th class="text-center">ESTADO</th>
                       <th class="text-center">OPCIONES</th>
                     </tfoot>
                   </table>
                 </div>

               </div>




             </div>
           </div>

         </div> <!-- Fin Row Principal -->
         <!-- ============================================================== -->
         <!-- End PAge Content -->
         <!-- ============================================================== -->
     </div>
     <!-- ============================================================== -->
     <!-- End Container fluid  -->
     <!-- ============================================================== -->

     <!-- ============================================================== -->


 <?php
  include "footer.php";
 ?>
 <script type="text/javascript" src="views/js/functions/usuario.js"></script>
 </body>
 </html>

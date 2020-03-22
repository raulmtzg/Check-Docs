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
                 <h3 class="text-themecolor">Bienvenido</h3>
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
             <div class="col-12">
                 <div class="card">
                     <div class="card-body">
                       <div class="row">
                         <div class="col-lg-offset-2 col-lg-8 text-center">
                           <h3 id="descripcion"></h3>
                         </div>
                       </div>
                       <br>
                       <div class="row">
                         <div class="col-md-3 ">
                           <!-- <img id="logoempresa" src="views/img/loading.gif" class="img img-responsive center-block" alt=""> -->
                         </div>
                         <div class="col-md-6 col-md-offset-3 ">
                           <img id="logoempresa" src="views/img/loading.gif" class="img img-responsive center-block" alt="">
                         </div>
                       </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- ============================================================== -->
         <!-- End PAge Content -->
         <!-- ============================================================== -->
     </div>
     <!-- ============================================================== -->
     <!-- End Container fluid  -->
     <!-- ============================================================== -->

<?php
  include "footer.php";
?>
<script src="views/js/functions/inicio.js"></script>
</body>
</html>

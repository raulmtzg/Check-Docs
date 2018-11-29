<?php
  class AdminPanel{

      public function listarController(){

          $rows= AdminPanelModels::listarModel("suscriptores");

          $data= Array();
          foreach ($rows as $row) {
            $info="";
            $info= "'".$row['idsuscriptor']."-".$row['nombre_empresa']."'";
            $data[]=array(
              "0"=>$row["idsuscriptor"],
              "1"=>$row["nombre_empresa"],
              "2"=>$row["rfc"],
              "3"=>($row['condicion']==1)?'<p class="text-center"><span class="label bg-green">ACTIVO</span></p>':
              '<p class="text-center"><span class="label bg-red">BAJA</span></p>',
              "4"=>($row['condicion']==1)?'<p class="text-center"><button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrar('.$row['idsuscriptor'].')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn  btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Desactivar" onclick="desactivar('.$info.')"><i class="fa fa-ban"></i></button>'.
                ' <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Usuario" onclick="mostrarUsuario('.$row['idsuscriptor'].')"><i class="fa fa-user"></i></button>'.
                ' <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Notificar" onclick="crearArchivo()"><i class="fa fa-envelope"></i></button></p>':
                '<p class="text-center"><button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Editar" onclick="mostrar('.$row['idsuscriptor'].')"><i class="fa fa-pencil"></i></button>'.
                '<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Activar" onclick="activar('.$info.')"><i class="fa fa-check"></i></button>'.
                '<button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Usuario" onclick="mostrarUsuario('.$row['idsuscriptor'].')"><i class="fa fa-user"></i></button>'.
                ' <button class="btn btn-sm btn-default" data-toggle="tooltip" data-placement="top" title="Notificar" onclick="crearArchivo()"><i class="fa fa-envelope"></i></button></p>'
              );
          }
          $results = array(
       			"sEcho"=>1, //Información para el datatables
       			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
       			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
       			"aaData"=>$data);
     		   echo json_encode($results);

      }

      public function mostrarController($idsuscriptor){

        $respuesta = AdminPanelModels::mostrarModel($idsuscriptor, "suscriptores");
        echo json_encode($respuesta);

      }

      public function insertarController($rfc, $nombre_empresa, $cantidad_admin, $telefono, $limite_usuarios, $capacidad_almacenamiento, $carpeta){
          //session_start();
          $parametros = ParametrosModels::parametrosModel();
          $fechaAlta= date($parametros['formatoFecha']);
          $datosController = array("rfc"                      =>  $rfc,
    								               "nombre_empresa"           =>  $nombre_empresa,
                                   "cantidad_admin"           =>  $cantidad_admin,
                                   "telefono"                 =>  $telefono,
                                   "limite_usuarios"          =>  $limite_usuarios,
                                   "capacidad_almacenamiento" =>  $capacidad_almacenamiento,
                                   "carpeta"                  => $carpeta,
                                   "logo"                     =>"views/img/logo_init.png",
                                   "condicion"                =>  "1",
    	                             "fecha_alta"                =>  $fechaAlta,
    	                             "usuario_alta"              =>  "SISTEMA"
    								               );

          $respuesta = AdminPanelModels::insertarModel($datosController, "suscriptores");
          //$respuesta="1";
          if( $respuesta== "1"){
            #Crea carpeta para procedimientos
            $estructura = '../../../views/modules/'.$carpeta;
            if(!mkdir($estructura, 0777, true)) {
              die('Fallo al crear las carpetas...');
            }

            #Crea carpeta para imagenes
            $rutaImagenes = '../../../views/img/'.$carpeta;
            if(!mkdir($rutaImagenes, 0777, true)) {
              die('Fallo al crear las carpetas...');
            }

            #Crea carpeta para documentos
            $rutaDocumentos = '../../../views/files/'.$carpeta;
            if(!mkdir($rutaDocumentos, 0777, true)) {
              die('Fallo al crear las carpetas...');
            }


          }
          echo $respuesta;
      }

      public function editarController($idsuscriptor, $rfc, $nombre_empresa, $cantidad_admin, $telefono, $limite_usuarios, $capacidad_almacenamiento){
         session_start();
         $parametros = ParametrosModels::parametrosModel();
         $fechaModificacion= date($parametros['formatoFecha']);
         $datosController = array("rfc"                      =>  $rfc,
                                  "nombre_empresa"           =>  $nombre_empresa,
                                  "cantidad_admin"           =>  $cantidad_admin,
                                  "telefono"                 =>  $telefono,
                                  "limite_usuarios"          =>  $limite_usuarios,
                                  "capacidad_almacenamiento" =>  $capacidad_almacenamiento,
                                  "fecha_modificacion"       =>  $fechaModificacion,
                                  "usuario_modificacion"     =>  "SISTEMA",
                                  "idsuscriptor"             => $idsuscriptor
                                  );



         $respuesta = AdminPanelModels::editarModel($datosController, "suscriptores");

         echo $respuesta;

      }

      public function desactivarController($idsuscriptor){
        session_start();
        $parametros = ParametrosModels::parametrosModel();
        $fechaModificacion= date($parametros['formatoFecha']);
        $datosController = array("idsuscriptor"         =>  $idsuscriptor,
                                 "condicion"             => "0",
                                 "fecha_modificacion"     =>  $fechaModificacion,
                                 "usuario_modificacion"   =>  "SISTEMA"
                                );

        $respuesta = AdminPanelModels::desactivarActivarModel($datosController, "suscriptores");

        echo $respuesta;

      }

      public function activarController($idsuscriptor){
        session_start();
        $parametros = ParametrosModels::parametrosModel();
        $fechaModificacion= date($parametros['formatoFecha']);
        $datosController = array("idsuscriptor"         =>  $idsuscriptor,
                                 "condicion"             => "1",
                                 "fecha_modificacion"     =>  $fechaModificacion,
                                 "usuario_modificacion"   =>  "SISTEMA"
                                );

        $respuesta = AdminPanelModels::desactivarActivarModel($datosController, "suscriptores");

        echo $respuesta;

      }


      public function insertarAdminController($idadmin, $idsuscriptor, $nombre_completo, $email){
          //session_start();
          // $logitud = 8;
          // $psswd = substr( md5(microtime()), 1, $logitud);

          $caracteres='ABCDEFGHIJKLMNOPQRSTUVWXYZabdefgijklmnopqrstuvwxyz013456789';
          $longpalabra=4;
          for($pass='', $n=strlen($caracteres)-1; strlen($pass) < $longpalabra ; ) {
            $x = rand(0,$n);
            $pass.= $caracteres[$x];
          }

          $password_usuario = 'chk2'.$pass;


          $parametros = ParametrosModels::parametrosModel();
          $fechaAlta= date($parametros['formatoFecha']);
          $datosController = array("nombre_completo"    =>  $nombre_completo,
    								               "email"              =>  $email,
                                   "perfil"             =>  1,
                                   "password_usuario"   =>  $password_usuario,
                                   "condicion"          =>  "1",
    	                             "fecha_alta"         =>  $fechaAlta,
    	                             "usuario_alta"       =>  "SISTEMA",
                                   "idsuscriptor"       => $idsuscriptor
    								               );

          $respuesta = AdminPanelModels::insertarAdminModel($datosController, "usuarios_suscriptores");

          echo $respuesta;


      }

      public function mostrarAdminController($idsuscriptor){

        $respuesta = AdminPanelModels::mostrarAdminModel($idsuscriptor, "1", "usuarios_suscriptores");
        echo json_encode($respuesta);

      }

      public function crearArchivoController(){
        $estructura = '../../modules/sacsi';
        if(!mkdir($estructura, 0777, true)) {
          die('Fallo al crear las carpetas...');
        }
        echo "carpeta";

      }



  }

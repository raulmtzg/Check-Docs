<?php

  class Conexion{
    public function conectar(){

      $link= new PDO ("mysql:host=localhost;dbname=checkdocs;charset=utf8","root","");
      return $link;


      //conexion en SQL
      // $link = new PDO("sqlsrv:Server=localhost,1433;Database=sipsanet", "sa", "Sugar.SH.1");
	    // return $link;


      // $SERVER_NAME = "pcsistemas\mssqlserver,1433";
      // $DATABASE="sipsanet";
      // $DB_USER="sa";
      // $DB_PASSWORD="password";
      // try
      // {
      //   $conn = new PDO("sqlsrv:server=$SERVER_NAME;DATABASE=$DATABASE",$DB_USER,$DB_PASSWORD);
      //   $conn->query("SET NAMES latin1");
      //   $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
      //   return $conn;
      // }catch(PDOException $e){
      //   echo $e->getMessage();
      //   die();
      // }




    }

  }

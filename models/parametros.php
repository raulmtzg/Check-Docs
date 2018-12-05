<?php

  class ParametrosModels{

    public function parametrosModel(){

        $parametros= Array();

        #===============Configuracion para Base de Datos MySql ====================
        $parametros['tipoBd']="Mysql";
        //formato fecha para MySql
        $parametros['formatoFecha']= "Y-m-d H:i";

        //MySql para inserciones que requieran el lastInsertId
        $parametros['serverName']="mysql:host=localhost";
        $parametros['dataBaseName']= "dbname=checkdocs;charset=utf8";
        $parametros['userDataBase']="root";
        $parametros['passwordDataBase']="";

        #========== Configuracion para base de datos SQLServer ========================
        //$parametros['tipoBd']="Sql";
        //formato fecha para SqlServer
        //$parametros['formatoFecha']= "Y-d-m H:i";



        //Sql para inserciones que requieran el lastInsertId
        // $parametros['serverName']="sqlsrv:Server=localhost,1433";
        // $parametros['dataBaseName']= "Database=sipsanet";
        // $parametros['userDataBase']="sa";
        // $parametros['passwordDataBase']="Sugar.SH.1";


        return $parametros;

    }


  }

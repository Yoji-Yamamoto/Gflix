<?php
    ob_start();
    session_start();
    date_default_timezone_set("Asia/Tokyo");

    try{
      //データベースへの接続
      /*$cleardb_server   = "us-cdbr-iron-east-04.cleardb.net";
      $cleardb_username = "b5cd25d5d3d7f6";
      $cleardb_password = "ee97cce7";
      $cleardb_db       = "heroku_c03b3b0d50ee556";
      $con = new PDO("mysql:dbname=$cleardb_db;host=$cleardb_server", "$cleardb_username","$cleardb_password");*/
          //ローカル環境でのdb接続
            $con = new PDO("mysql:dbname=Gflix;host=localhost", "root","root");
      
      //PDOのエラーレポート
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e){
      exit("Connection failed: " . $e->getMessage());
  }

?>
<?php
    ob_start();
    session_start();
    date_default_timezone_set("Asia/Tokyo");

    try{
      //データベースへの接続
      $cleardb_url      = parse_url(getenv("CLEARDB_DATABASE_URL"));
      $cleardb_server   = $cleardb_url["host"];
      $cleardb_username = $cleardb_url["user"];
      $cleardb_password = $cleardb_url["pass"];
      $cleardb_db       = substr($cleardb_url["path"],1);
      $con = new PDO("mysql:dbname=$cleardb_url;host=$cleardb_server", "$cleardb_username","$cleardb_password");
      /*    ローカル環境でのdb接続
            $con = new PDO("mysql:dbname=Gflix;host=localhost", "root","root");
      */
      //PDOのエラーレポート
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  }
  catch (PDOException $e){
      exit("Connection failed: " . $e->getMessage());
  }

?>
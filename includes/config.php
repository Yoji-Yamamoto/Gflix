<?php
    ob_start();
    session_start();
    date_default_timezone_set("Asia/Tokyo");
    
    try{
        //データベースへの接続
        $con = new PDO("mysql:dbname=Gflix;host=localhost", "root","root");
        //PDOのエラーレポート
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    catch (PDOException $e){
        exit("Connection failed: " . $e->getMessage());
    }

?>
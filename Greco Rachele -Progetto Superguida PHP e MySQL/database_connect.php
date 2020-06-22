<?php

$serverName = "localhost";
$uName = "root";
$psw = "";
$dbName = "to_do_list";


try {


  $conn = new PDO("mysql:host=$serverName;dbname=$dbName",
                  $uName, $psw);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo "Connessione fallita..". $e->getMessage();
}




 ?>

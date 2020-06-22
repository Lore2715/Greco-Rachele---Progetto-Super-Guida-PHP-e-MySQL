<?php

   require '../database_connect.php';

   $id = $_GET["id"];
   $del ="DELETE FROM notes WHERE id = '$id'";
   $res =$conn->query($del);
     if($res){
   header('location: ../index.php');
   };

 ?>

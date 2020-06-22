<?php

/* ADD GOALS */

 if(isset($_POST['goals'])) {
   require '../database_connect.php';

     $goals = $_POST['goals'];

     if(empty($goals)){
       header("Location: ../index.php?mess=error");
     } else {

       $stmt2 = $conn->prepare("INSERT INTO goals(title) VALUE(?)");
       $res = $stmt2->execute([$goals]);

       if($res) {
        header("Location: ../index.php?mess=success");
      } else {
         header("Location: ../index.php");
       }
        $conn = null;
         exit();
     }
      }else {
     header("Location: ../index.php?mess=error");
 }



/* ADD TO DO */

  if(isset($_POST['title'])) {
    require '../database_connect.php';

      $title = $_POST['title'];

      if(empty($title)){
        header("Location: ../index.php?mess=error");
      } else {

        $stmt = $conn->prepare("INSERT INTO todos(nome) VALUE(?)");
        $res = $stmt->execute([$title]);

        if($res) {
         header("Location: ../index.php?mess=success");
       } else {
          header("Location: ../index.php");
        }
         $conn = null;
          exit();
      }
       }else {
      header("Location: ../index.php?mess=error");
  }




  /* ADD Notes */

   if(isset($_POST['notes'])) {
     require '../database_connect.php';

       $notes = $_POST['notes'];

       if(empty($notes)){
         header("Location: ../index.php?mess=error");
       } else {

         $stmt3 = $conn->prepare("INSERT INTO notes(note) VALUES(?)");

         $res = $stmt3->execute([$notes]);

         if($res) {
          header("Location: ../index.php?mess=success");
        } else {
           header("Location: ../index.php");
         }
          $conn = null;
           exit();
       }
        }else {
       header("Location: ../index.php?mess=error");
   }

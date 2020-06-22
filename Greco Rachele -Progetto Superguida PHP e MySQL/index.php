
<?php
require "database_connect.php";

 ?>

<!DOCTYPE html>
 <html lang='en'>
 <head>

   <meta charset='UTF-8'>
   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
   <meta http-equiv='X-UA-Compatible' content='ie=edge'>

  <title> My To-Do List</title>
  <link rel='stylesheet' href='CSS/style.css'/>

</head>


<body>


<article class="site_cont">
 <article class="site">
  <section class='TodoSection'>

      <div class="frame">
       <div class='sect-form'>
        <form action="controllers/addelements.php" method="POST" autocomplete="off"/>

    <?php  if(isset($_GET['mess']) && $_GET['mess'] == 'error') {?>  <!-- nel caso si lascia l'input vuoto... -->
          <input type="text" name='title' placeholder="Questo campo non può essere vuoto!"/>
           <button id="submitTask" type="submit"> Aggiungi <span>&#43;</span></button>

    <?php } else { ?>
          <input type="text" name='title' placeholder="Inserisci qui le tue tasks!"/>
           <button id="submitTask" type="submit"> Aggiungi <span>&#43;</span></button>
    <?php } ?>

        </div> <!-- chiusura di sect-form! -->

    <?php
         $todos=$conn->query("SELECT * FROM todos ORDER BY id DESC "); // Qui ottieni elementi dal database!
     ?>
         <div class="todos-sect">
   <?php
        while($todo = $todos->fetch(PDO::FETCH_ASSOC)) {
         $dates = substr($todo["data"], 0, 10);
         $newDate = date("d-m-Y", strtotime($dates));
    ?>
              <div class='todos'>
               <div>
                <a  class="Delete_task" href="controllers/delete.php?id=<?= $todo['id'] ?>">X</a>
              </div>
               <div class="column">
                <p class="nametask"> <?= $todo["nome"]?> </p>
                 <p class='date'> creato il: <?php echo $newDate; ?> </p>
              </div>
               <div class="column2">


               <form action="controllers/check.php" method="POST">
    <?php if($todo['checked']){ ?>
              <label class="container">
               <input type="checkbox" class="check-box" data-todo-id ="<?php echo $todo['id']; ?>" checked />
                <span class="checkmark"></span>
                 </label>

    <?php }else { ?>
               <label class="container">
                 <input type="checkbox" data-todo-id ="<?php echo $todo['id']; ?>" class="check-box" />
                  <span class="checkmark"></span>
                 </label>

     <?php } ?>
              </div>
            </div>

         <?php } ?>

        </div>
      </div>
    </section>

    <!-- GOALS SECTION-->
<section class=" GoNo">
      <section class='GoalsSection'>
        <div class="framegoals">
          <div class='goals-form'>
            <?php  if(isset($_GET['mess']) && $_GET['mess'] == 'error') {?>
            <form action="controllers/addelements.php" method="POST" autocomplete="off"/>
            <input type="text" name='goals' placeholder="Questo campo non può essere vuoto!"/>
            <button id="goals" type="submit"> Aggiungi <span>&#43;</span></button>

            <?php } else { ?>

            <form action="controllers/addelements.php" method="POST" autocomplete="off"/>
            <input type="text" name='goals' placeholder="Inserisci qui il tuo Goal!"/>
            <button id="goals" type="submit"> Aggiungi <span>&#43;</span></button>
          </div>
     <?php }

           $goals=$conn->query("SELECT * FROM goals ORDER BY id DESC ");
    ?>
         <div class="todos-sect">

    <?php while($goal = $goals->fetch(PDO::FETCH_ASSOC)) { ?>

          <div class='todos'>
            <p class="nametask"> <?= $goal["title"]?> </p>
            <div>
            <a  class="Delete_goals" href="controllers/deletegoals.php?id=<?= $goal['id'] ?>">X</a>
          </div>
          </div>
         </div>
    <?php } ?>


      </div>
     </div>
    </section>



    <!-- NOTES SECTION-->

    <section class='NotesSection'>
      <div class="framenotes">
        <div class='goals-form'>

    <?php  if(isset($_GET['mess']) && $_GET['mess'] == 'error') {?>
          <form action="controllers/addnotes.php" method="POST" autocomplete="off">
          <textarea type="text" rows="4" cols="10" name='notes' placeholder= "Non puoi lasciare questo campo vuoto!"/></textarea>
          <button id="Notes" type="submit"> Aggiungi <span>&#43;</span></button>

    <?php } else { ?>

          <form action="controllers/addnotes.php" method="POST" autocomplete="off">
          <textarea type="text" rows="4" cols="10" name='notes' placeholder= "Le tue annotazioni!"/></textarea>
          <button id="Notes" type="submit"> Aggiungi <span>&#43;</span></button>

    <?php }  ?>
          </div>

    <?php
           $notes=$conn->query("SELECT * FROM notes ORDER BY id DESC ");
    ?>
         <div class="todos-sect">

    <?php while($noted = $notes->fetch(PDO::FETCH_ASSOC)) { ?>

          <div class='todos'>
            <p class="namegn"> <?= $noted["note"]?> </p>
            <div>
            <a  class="Delete_notes" href="controllers/deletenotes.php?id=<?= $noted['id'] ?>">X</a>
          </div>
          </div>
         </div>
    <?php } ?>


      </div>
     </div>
    </section>
</section>
   </article>
  </article>

  <script src="js/jquery-3.2.1.min.js"></script>

   <script>
       $(document).ready(function(){
           $(".check-box").click(function(e){
               const id = $(this).attr('data-todo-id');

               $.post('controllers/check.php',
                     {
                         id: id
                     },
                     (data) => {
                         if(data != 'error'){
                             const h2 = $(this).next();
                             if(data === '1'){
                                 h2.removeClass('checked');
                             }else {
                                 h2.addClass('checked');
                             }
                         }
                     }
               );
           });
       });
   </script>

 </body>
</html>
